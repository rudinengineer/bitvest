@extends('layouts.main')
@section('container')
<div class="mt-16 p-4 sm:grid grid-cols-2">
    <div class="sm:h-screen border-r-[1px] border-slate-300 sm:p-2">
        <div class="px-5 py-6 rounded-md bg-gradient-to-tr from-primary to-green-400 border-[1px] border-slate-300 shadow-md">
            <h1 class="text-2xl font-bold text-light">Rp {{ number_format(auth()->user()->saldo, 0, '.', '.') }}</h1>
            <h1 class="font-semibold mt-1 text-light">Saldo saya</h1>
        </div>
        <div class="mt-4 flex gap-2 justify-between items-center">
            <a href="/saldo/deposit" class="flex gap-1 justify-center items-center w-1/2 py-3 rounded-md text-primary border-[1px] border-primary transition ease-in-out hover:bg-slate-100">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                                  
                </div>
                <h1 class="text-base font-semibold">Deposit</h1>
            </a>
            <a href="/saldo/withdraw" class="flex gap-1 justify-center items-center w-1/2 py-3 rounded-md bg-primary text-light border-[1px] border-primary transition ease-in-out hover:bg-opacity-90">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>                  
                </div>
                <h1 class="text-base font-semibold">Withdraw</h1>
            </a>
        </div>
    </div>
    <div class="mt-6 sm:mt-2 sm:px-4">
        @include('components.transaction_history')
    </div>
</div>
@endsection