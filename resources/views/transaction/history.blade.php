@extends('layouts.main')
@section('container')
<div class="mt-16 p-4 sm:grid grid-cols-2">
    <div class="hidden sm:flex">
        <img src="{{ asset('/assets/images/pay.png') }}" alt="Payment Image" class="w-full h-full">
    </div>
    <div class="sm:px-10 sm:py-5">
        @include('components.transaction_history')
    </div>
</div>
@endsection