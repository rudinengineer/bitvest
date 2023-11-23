<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'title' => 'Dashboard',
            'users' => User::where('role', 'user')->get(),
            'admins' => User::where('role', 'admin')->orWhere('role', 'superadmin')->get(),
            'transactions' => Transaction::all(),
            'withdraw' => Transaction::where('type', 'withdraw')->get(),
            'products' => Product::all(),
            'pengunjung' => Pengunjung::all()
        ]);
    }

    public function products() {
        if ( auth()->user()->role === 'superadmin' ) {
            return view('admin.products', [
                'title' => 'Proyek',
                'products' => Product::latest()->get()
            ]);
        } else {
            return redirect('/admin');
        }
    }

    public function users() {
        return view('admin.users', [
            'title' => 'Pengguna',
            'users' => User::where('role', 'user')->get()
        ]);
    }

    public function admins() {
        if ( auth()->user()->role === 'superadmin' ) {
            return view('admin.admins', [
                'title' => 'Admin',
                'users' => User::where('role', 'superadmin')->orWhere('role', 'admin')->get()
            ]);
        } else {
            return redirect('/admin');
        }
    }

    public function settings() {
        return view('admin.settings', [
            'title' => 'Pengaturan',
            'setting' => Setting::first()
        ]);
    }

    public function transactions() {
        return view('admin.transactions', [
            'title' => 'Transaksi',
            'transactions' => Transaction::with(['user', 'product'])->orWhere('type', 'investasi')->orWhere('type', 'withdraw')->orWhere('type', 'deposit')->latest()->get()
        ]);
    }

    public function withdraw() {
        return view('admin.withdraw', [
            'title' => 'Withdraw',
            'withdraws' => Transaction::with(['user'])->where('type', 'withdraw')->latest()->get()
        ]);
    }

    public function deposit() {
        return view('admin.deposit', [
            'title' => 'Deposit',
            'deposits' => Transaction::with(['user'])->where('type', 'deposit')->latest()->get()
        ]);
    }

    public function store(Request $request) {
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = $request->validate([
                'username' => 'required|min:3|unique:users',
                'email' => 'required|min:3|unique:users',
                'password' => 'required|min:3',
                'role' => 'required'
            ], [
                'required' => ':attribute harus di isi!',
                'min' => ':attribute harus berisi minimal 3 angka!',
                'unique' => ':attribute sudah digunakan!'
            ]);
            $credentials['password'] = bcrypt($request->password);
            $referal_code = "";
            for ($i=0; $i < 8; $i++) { 
                $referal_code .= random_int(0, 9);
            }
            $credentials['referal_code'] = $referal_code;
            if ( User::create($credentials) ) {
                return redirect('/admin/admins')->with('success', 'Data berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Data gagal ditambahkan!');
            }
        } else {
            return redirect('/admin');
        }
    }

    public function update(Request $request, User $user) {
        $username = $request->username === $user->username ?'required|min:3':'required|min:3|unique:users';
        $email = $request->email === $user->email ?'required|min:3':'required|min:3|unique:users';
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = $request->validate([
                'username' => $username,
                'email' => $email,
                'role' => 'required'
            ], [
                'required' => ':attribute harus di isi!',
                'min' => ':attribute harus berisi minimal 3 angka!',
                'unique' => ':attribute sudah digunakan!'
            ]);
            if ( $request->password ) {
                $credentials['password'] = bcrypt($request->password);
            }
            if ( User::where('id', $user->id)->update($credentials) ) {
                return redirect('/admin/admins')->with('success', 'Data berhasil diubah!');
            } else {
                return back()->with('error', 'Data gagal diubah!');
            }
        } else {
            return redirect('/admin');
        }
    }

    public function destroy(User $user) {
        if ( auth()->user()->role === 'superadmin' ) {
            if ( User::destroy($user->id) ) {
                return redirect('/admin/admins')->with('success', 'Data berhasil dihapus!');
            } else {
                return back()->with('error', 'Data gagal dihapus!');
            }
        } else {
            return redirect('/admin');
        }
    }
}
