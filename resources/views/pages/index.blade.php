@extends('layouts.main')
@section('container')
<div class="mt-16">
    @if ($products->count())
        <div class="w-full grid grid-cols-1 ss:grid-cols-2 md:grid-cols-3 px-4 py-2 sm:px-2">
            @foreach ($products as $product)
            @include('components.products')
            @endforeach
        </div>
    @else
        <div class="p-6 w-full flex justify-center">
            <h1 class="text-xs sm:text-base text-center">Data tidak ditemukan.</h1>
        </div>
    @endif
</div>
@endsection