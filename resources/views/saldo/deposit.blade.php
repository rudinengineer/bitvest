@extends('layouts.main')
@section('container')
<div class="mt-16 p-4 sm:grid grid-cols-2">
    <div class="hidden sm:flex">
        <img src="{{ asset('/assets/images/deposit.png') }}" alt="Deposit Image" class="w-full h-full">
    </div>
    <div class="sm:p-6">
        <form action="/saldo/deposit" method="post">
            @method('post')
            @csrf
            <h1 class="text-2xl font-bold text-center text-primary">Deposit Saldo</h1>
            <p class="text-center">Masukkan nominal deposit untuk melanjutkan.</p>
            <div class="mt-2">
                <div>
                    @error('total')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="sticky">
                        <div class="absolute top-[11px] left-3 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                        </div>
                        <input type="number" name="total" id="total" placeholder="Rp 0" class="input-deposit w-full outline-none px-4 pl-10 py-3 rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('total') }}">
                    </div>
                </div>
            </div>
            {{-- <div class="mt-4">
                <h1 class="text-base font-bold">Metode Pembayaran</h1>
                @error('payment_method')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <div class="mt-2">
                    <label for="payment_method" class="cursor-pointer w-full flex justify-between items-center px-4 py-2 rounded-md border-[1px] border-primary">
                        <div class="flex gap-2 items-center">
                            <input type="radio" name="payment_method" id="payment_method" class="accent-primary" value="qris">
                            <h1 class="font-bold">QRIS</h1>
                        </div>
                        <div>
                            <img src="{{ asset('/assets/images/qris.png') }}" alt="Qris Image" class="w-8 h-8 aspect-square rounded-md">
                        </div>
                    </label>
                </div>
            </div> --}}
            <div class="mt-6">
                <div class="w-full flex justify-between items-center">
                    <h1>Deposit</h1>
                    <h1 class="deposit-price font-bold">Rp 0</h1>
                </div>
                <div class="mt-1 w-full flex justify-between items-center">
                    <h1>Biaya Admin</h1>
                    <h1 class="admin-price font-bold" data-price="1000">Rp 1.000</h1>
                </div>
                <div class="mt-1 w-full flex justify-between items-center">
                    <h1>Total Harga</h1>
                    <h1 class="price-total font-bold">Rp 0</h1>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-submit w-full flex justify-center items-center py-3 rounded-md bg-primary font-bold text-light transition duration-300 ease-in-out hover:bg-opacity-90"><span>Lanjutkan Pembayaran</span>@include('components.loader')</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('/assets/js/loader.js') }}"></script>
<script>
    $(function() {
        $('.input-deposit').on('change', function(e) {
            $('.deposit-price').text('Rp' + Intl.NumberFormat('id-ID').format(e.target.value).replace(',', '.'))
            if ( e.target.value ) {
                $('.price-total').text('Rp' + Intl.NumberFormat('id-ID').format(parseInt(e.target.value) + parseInt($('.admin-price').attr('data-price'))).replace(',', '.'))
            } else {
                $('.price-total').text('Rp 0')
            }
        })
    })
</script>
@endsection