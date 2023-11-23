<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        if ( request()->keyword ) {
            $keyword = request()->keyword;
            $data = Product::where('title', 'like', '%' . $keyword . '%')->orWhere('jumlah_proyek', 'like', '%' . $keyword . '%')->orWhere('keuntungan_harian', 'like', '%' . $keyword . '%')->orWhere('jumlah_pemasukan', 'like', '%' . $keyword . '%')->orWhere('siklus', 'like', '%' . $keyword . '%')->orWhere('price', 'like', '%' . $keyword . '%')->inRandomOrder()->get();
        } else {
            $data = Product::inRandomOrder()->get();
        }
        return view('pages.index', [
            'title' => env('APP_NAME'),
            'products' => $data
        ]);
    }

    public function saldo() {
        return view('saldo.index', [
            'title' => env('APP_NAME') . ' - Saldo',
            'transactions' => Transaction::where('user_id', auth()->user()->id)->orWhere('type', 'deposit')->orWhere('type', 'withdraw')->get()
        ]);
    }

    public function search(Request $request) {
        if ( $request->keyword ) {
            $keyword = $request->keyword;
            $data = Product::where('title', 'like', '%' . $keyword . '%')->orWhere('jumlah_proyek', 'like', '%' . $keyword . '%')->orWhere('keuntungan_harian', 'like', '%' . $keyword . '%')->orWhere('jumlah_pemasukan', 'like', '%' . $keyword . '%')->orWhere('siklus', 'like', '%' . $keyword . '%')->orWhere('price', 'like', '%' . $keyword . '%')->inRandomOrder()->get();
        } else {
            $data = Product::inRandomOrder()->get();
        }
        return view('pages.search', [
            'title' => 'Search',
            'products' => $data
        ]);
    }

    public function checkout(Product $product) {
        return view('transaction.checkout', [
            'title' => 'Checkout',
            'product' => $product
        ]);
    }

    public function signin() {
        return view('pages.signin', [
            'title' => env('APP_NAME') . ' - Masuk'
        ]);
    }

    public function signup() {
        return view('pages.signup', [
            'title' => env('APP_NAME') . ' - Daftar'
        ]);
    }
}
