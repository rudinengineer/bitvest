<?php

namespace App\Http\Controllers;

use App\Models\Investasi;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function paid(Transaction $transaction) {
        if ( in_array(auth()->user()->role, ['superadmin', 'admin']) ) {
            if ( Transaction::where('id', $transaction->id)->update(['status' => 'paid']) ) {
                if ( $transaction->type === 'deposit' ) {
                    $saldo = intval($transaction->user->saldo) + intval($transaction->total);
                } elseif($transaction->type === 'withdraw') {
                    $saldo = intval($transaction->user->saldo) - intval($transaction->total);
                } else {
                    $saldo = auth()->user()->saldo;
                }
                User::where('id', $transaction->user_id)->update(['saldo' => $saldo]);
                return redirect('/admin/transactions')->with('success', 'Transaksi berhasil diselesaikan!');
            } else {
                return redirect('/admin/transactions')->with('error', 'Transaksi gagal diselesaikan!');
            }
        }
    }

    public function unpaid(Transaction $transaction) {
        if ( in_array(auth()->user()->role, ['superadmin', 'admin']) ) {
            if ( Transaction::where('id', $transaction->id)->update(['status' => 'unpaid']) ) {
                return redirect('/admin/transactions')->with('success', 'Transaksi berhasil dibatalkan!');
            } else {
                return redirect('/admin/transactions')->with('error', 'Transaksi gagal dibatalkan!');
            }
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaction.history', [
            'title' => env('APP_NAME') . ' - History',
            'transactions' => Transaction::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        try {
            $detail = \Midtrans\Transaction::status($transaction->code);
        } catch(\Throwable $th) {
            $setting = Setting::first();
            $payment = Snap::createTransaction(array(
                'transaction_details' => array(
                    'order_id' => $transaction->code,
                    'gross_amount' => intval($transaction->total) + intval($setting->biaya_admin)
                ),
                "customer_details" => array(
                    "first_name" => auth()->user()->first_name,
                    "last_name" => auth()->user()->last_name,
                    "email" => auth()->user()->email,
                    "phone" => auth()->user()->phone
                )
            ));
            Transaction::where('uuid', $transaction->uuid)->update([
                'snap_token' => $payment->token,
                'redirect_url' => $payment->redirect_url
            ]);
            return redirect($payment->redirect_url);
        }
        if ( $detail->transaction_status === "settlement" && $transaction->status !== "paid" ) {
            Transaction::where('uuid', $transaction->uuid)->update(['status' => 'paid']);
            User::where('id', auth()->user()->id)->update([
                'saldo' => intval(auth()->user()->saldo) + intval($transaction->total)
            ]);
            return redirect('/transaction/history');
        }
        if ( $detail->transaction_status === "pending" ) {
            return redirect($transaction->redirect_url);
        } else {
            return redirect('/transaction/history');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if ( in_array(auth()->user()->role, ['superadmin', 'admin']) ) {
            if ( Transaction::destroy($transaction->id) ) {
                return redirect('/admin/transactions')->with('success', 'Data berhasil dihapus!');
            } else {
                return redirect('/admin/transactions')->with('error', 'Data gagal dihapus!');
            }
        }
    }
}
