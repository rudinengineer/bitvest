<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saldo.withdraw', [
            'title' => env('APP_NAME') . ' - Withdraw',
            'setting' => Setting::first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'total' => 'required|int',
            'credit_card' => 'required'
            // 'payment_method' => 'required'
        ], [
            'required' => ':attribute harus di isi!',
            'int' => ':attribute harus bernilai nomor'
        ]);
        $setting = Setting::first();
        if ( intval($request->total) < intval($setting->minimal_wd) ) {
            return back()->with('error', 'Jumlah withdraw minimal Rp ' . number_format(intval($setting->minimal_wd), 0, '.', '.'));
        }
        if ( intval($request->total) > intval(auth()->user()->saldo) ) {
            return back()->with('error', 'Saldo akun tidak mencukupi!');
        }
        $credentials['uuid'] = Str::uuid()->toString();
        $credentials['code'] = 'PAY-' . mt_rand(10000000, 999999999);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['credit_card'] = $request->credit_card;
        $credentials['total'] = $request->total;
        $credentials['biaya_admin'] = $setting->biaya_admin;
        $credentials['subtotal'] = intval($request->total) - intval($setting->biaya_admin);
        $credentials['type'] = 'withdraw';
        if ( Transaction::create($credentials) ) {
            return redirect('/transaction/history');
        } else {
            return back()->with('error', 'Gagal melakukan withdraw!');
        }
    }
}
