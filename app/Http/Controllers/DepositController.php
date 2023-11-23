<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Snap;

class DepositController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }
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
        return view('saldo.deposit', [
            'title' => env('APP_NAME') . ' - Deposit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'total' => 'required|int'
        ], [
            'required' => ':attribute harus di isi!',
            'int' => ':attribute harus berisi nomor!'
        ]);
        $setting = Setting::first();
        $credentials['uuid'] = Str::uuid()->toString();
        $credentials['user_id'] = auth()->user()->id;
        $code = 'PAY-' . mt_rand(10000000, 999999999);
        $transaction = new Transaction();
        $transaction->uuid = Str::uuid()->toString();
        $transaction->code = $code;
        $transaction->user_id = auth()->user()->id;
        $transaction->total = $request->total;
        $transaction->biaya_admin = $setting->biaya_admin;
        $transaction->subtotal = intval($request->total) + intval($setting->biaya_admin);
        $transaction->type = 'deposit';
        $payment = Snap::createTransaction(array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => intval($request->total) + intval($setting->biaya_admin)
            ),
            "customer_details" => array(
                "first_name" => auth()->user()->first_name,
                "last_name" => auth()->user()->last_name,
                "email" => auth()->user()->email,
                "phone" => auth()->user()->phone
            )
        ));
        $transaction->snap_token = $payment->token;
        $transaction->redirect_url = $payment->redirect_url;
        $transaction->save();
        if ( $transaction ) {
            Deposit::create($credentials);
        }
        return redirect($payment->redirect_url);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposit $deposit)
    {
        return view('saldo.qris', [
            'title' => env('APP_NAME') . ' - Transaction',
            'deposit' => $deposit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
