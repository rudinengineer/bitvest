@extends('layouts.main')
@section('container')
    <div class="mt-16 sm:grid grid-cols-2">
        <div class="hidden sm:flex p-4 border-r-[1px] border-slate-300">
            <img src="{{ asset('/assets/images/withdraw.png') }}" alt="Checkout Image" class="w-full h-full">
        </div>
        <div class="sm:mt-8 p-4">
            <h1 class="text-2xl font-bold text-center text-primary">Beli Paket</h1>
            <div class="mt-2 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Nama Paket</h1>
                <h1 class="font-semibold sm:text-base">{{ $product->title }}</h1>
            </div>
            <div class="mt-0.5 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Jumlah Proyek</h1>
                <h1 class="font-semibold sm:text-base">{{ number_format($product->jumlah_proyek, 0) }}</h1>
            </div>
            <div class="mt-0.5 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Keuntungan Harian</h1>
                <h1 class="font-semibold sm:text-base">{{ $product->keuntungan_harian }}%</h1>
            </div>
            <div class="mt-0.5 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Jumlah Pemasukan</h1>
                <h1 class="font-semibold sm:text-base">{{ number_format($product->jumlah_pemasukan, 0) }}</h1>
            </div>
            <div class="mt-0.5 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Siklus</h1>
                <h1 class="font-semibold sm:text-base">{{ $product->siklus }} hari</h1>
            </div>
            <div class="mt-0.5 w-full flex justify-between items-center">
                <h1 class="text-xs sm:text-sm">Harga Paket</h1>
                <h1 class="font-semibold sm:text-base">Rp {{ number_format($product->price, 0, '.', '.') }}</h1>
            </div>
            <div class="mt-4">
                <a href="/{{ $product->uuid }}/buy">
                    <button class="btn-submit w-full flex justify-center bg-primary py-2 rounded-md font-bold text-light transition ease-in-out hover:bg-opacity-90">
                        <span class="flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <h1>Beli Paket</h1>
                        </span>
                        @include('components.loader')
                    </button>
                </a>
            </div>
        </div>
    </div>
<script src="{{ asset('/assets/js/loader.js') }}"></script>
@endsection