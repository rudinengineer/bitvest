<?php

namespace App\Http\Controllers;

use App\Models\Investasi;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function buy(Product $product) {
        if ( intval(auth()->user()->saldo) >= intval($product->price) ) {
            $setting = Setting::first();
            $code = "PAY-" . mt_rand(100000, 9999999);
            $transaction = new Transaction();
            $transaction->uuid = Str::uuid()->toString();
            $transaction->code = $code;
            $transaction->user_id = auth()->user()->id;
            $transaction->product_id = $product->id;
            $transaction->total = $product->price;
            $transaction->biaya_admin = $setting->biaya_admin;
            $transaction->subtotal = intval($product->price) + intval($setting->biaya_admin);
            $transaction->type = "investasi";
            $transaction->status = "paid";
            $transaction->save();
            if ( $transaction ) {
                Investasi::create([
                    'uuid' => Str::uuid()->toString(),
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'total' => $product->price
                ]);
                User::where('id', auth()->user()->id)->update([
                    'saldo' => intval(auth()->user()->saldo) - intval($product->price)
                ]);
            }
            return redirect('/transaction/history')->with('success', 'Paket berhasil dibeli!');
        } else {
            return back()->with('error', 'Saldo akun tidak mencukupi!');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = $request->validate([
                'title' => 'required|min:3',
                'jumlah_proyek' => 'required|int',
                'keuntungan_harian' => 'required|int',
                'jumlah_pemasukan' => 'required|int',
                'siklus' => 'required|int',
                'price' => 'required|int',
                'image' => 'file|image'
            ], [
                'required' => ':attribute harus di isi!',
                'min' => ':attribute minimal 3 karakter!',
                'int' => ':attribute harus berisi nomor!'
            ]);
            $credentials['uuid'] = Str::uuid()->toString();
            $credentials['user_id'] = auth()->user()->id;
            if ( $request->file('image') ) {
                $filename = $request->file('image')->hashName();
                $image = $request->file('image')->storeAs('public/images/products', $filename);
                if ( $image ) {
                    $credentials['image'] = $filename;
                }
            }
            if ( Product::create($credentials) ) {
                return redirect('/admin/products')->with('success', 'Data berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Data gagal ditambahkan!');
            }
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = $request->validate([
                'title' => 'required|min:3',
                'jumlah_proyek' => 'required|int',
                'keuntungan_harian' => 'required|int',
                'jumlah_pemasukan' => 'required|int',
                'siklus' => 'required|int',
                'price' => 'required|int',
                'image' => 'file|image'
            ], [
                'required' => ':attribute harus di isi!',
                'min' => ':attribute minimal 3 karakter!',
                'int' => ':attribute harus berisi nomor!'
            ]);
            if ( $request->file('image') ) {
                $filename = $request->file('image')->hashName();
                $image = $request->file('image')->storeAs('public/images/products', $filename);
                if ( $image ) {
                    Storage::delete('public/images/products/' . $product->image);
                    $credentials['image'] = $filename;
                }
            }
            if ( Product::where('uuid', $product->uuid)->update($credentials) ) {
                return redirect('/admin/products')->with('success', 'Data berhasil diubah!');
            } else {
                return back()->with('error', 'Data gagal diubah!');
            }
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            if ( Product::where('uuid', $product->uuid)->delete() ) {
                Storage::delete('public/images/products/' . $product->image);
                return redirect('/admin/products')->with('success', 'Data berhasil dihapus!');
            } else {
                return back()->with('error', 'Data gagal dihapus!');
            }
        } else {
            return redirect('/admin');
        }
    }
}
