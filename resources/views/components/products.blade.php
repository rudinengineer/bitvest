<div class="mt-4 sm:px-1">
    <div class="w-full h-full flex gap-2 flex-col justify-between bg-light rounded-md border-[1px] border-slate-300 shadow-md p-4">
        <div class="grid grid-cols-[1fr__2fr]">
            <div class="grid justify-center items-center">
                @if($product->image)
                    <img src="{{ asset('/storage/images/products/' . $product->image) }}" class="w-16 h-16" alt="{{ $product->title }}">
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-primary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>                          
                @endif
            </div>
            <div>
                <h1 class="text-base sm:text-lg font-bold">{{ $product->title }}</h1>
                <h1 class="text-xs">Jumlah Proyek : <span class="font-semibold">{{ number_format($product->jumlah_proyek, 0) }}</span></h1>
                <h1 class="text-xs">Keuntungan Harian : <span class="font-semibold">{{ $product->keuntungan_harian }}%</span></h1>
                <h1 class="text-xs">Jumlah Pemasukan : <span class="font-semibold">{{ number_format($product->jumlah_pemasukan, 0) }}</span></h1>
                <h1 class="text-xs">Siklus : <span class="font-semibold"><span class="font-semibold">{{ $product->siklus }} hari</span></h1>
            </div>
        </div>
        <a href="/{{ $product->uuid }}">
            <button class="w-full flex justify-center gap-2 items-center bg-primary py-2 rounded-md font-bold text-light transition ease-in-out hover:bg-opacity-90">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <h1>Beli Paket</h1>
            </button>
        </a>
    </div>
</div>