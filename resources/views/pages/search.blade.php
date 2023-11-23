@extends('layouts.main')
@section('container')
<div class="mt-16 sm:hidden">
    <form action="/search" method="get" class="w-full grid grid-cols-[3fr__1fr] gap-1 items-center p-4">
        <div>
            <input type="text" name="keyword" id="" class="w-full px-4 py-3 outline-none rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" autocomplete="off">
        </div>
        <button type="submit" class="w-full py-3 rounded-md bg-primary font-bold text-light">Search</button>
    </form>
    @if ($products->count())
    @foreach ($products as $product)
    <div class="px-4">
        @include('components.products')
    </div>
    @endforeach
    @else
        <div class="w-full flex justify-center">
            <h1 class="text-xs text-center">Data tidak ditemukan.</h1>
        </div>
    @endif
    {{-- <div class="px-4 py-2">
        <h1 class="font-bold">Pencarian terbaru</h1>
        <a href="/search?keyword=" class="flex justify-between items-center">
            <div class="flex gap-2 items-center transition ease-in-out hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                </svg>
                <h1>saham bca murah</h1>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    <title>hapus</title>
                </svg>
            </div>
        </a>
        <div class="mt-2">
            <h1 class="font-bold">Pencarian terpopuler</h1>
            <div class="flex gap-2 items-center transition ease-in-out hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                </svg>
                <h1>saham bca murah</h1>
            </div>
        </div>
    </div> --}}
</div>
@endsection