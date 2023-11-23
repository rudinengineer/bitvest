<div>
    <h1 class="text-base font-bold sm:text-xl">Riwayat Transaksi</h1>
    <div>
        @if ($transactions->count())
        @foreach ($transactions as $transaction)
            <a @if($transaction->type === "deposit" && $transaction->status === "pending")href="/transaction/{{ $transaction->uuid }}" @endif class="mt-2 w-full flex justify-between items-center transition ease-in-out hover:bg-slate-100 p-2">
                <div>
                    <div class="flex gap-1.5">
                        <h1 class="text-base font-bold">+{{ number_format($transaction->total, 0, '.', '.') }}</h1>
                        <h1 class="text-xs rounded-md font-semibold {{ $transaction->status === 'pending' ? 'text-yellow-500' : ($transaction->status === 'paid' ? 'text-green-500' : 'text-red-500') }}">{{ $transaction->status }}</h1>
                    </div>
                    <h1 class="text-xs">{{ $transaction->created_at->format('Y-m-d') }}</h1>
                </div>
                <h1 class="text-xs px-3 py-1.5 {{ $transaction->type === 'deposit' ? 'bg-primary' : ($transaction->type === 'withdraw' ? 'bg-red-500' : 'bg-yellow-500') }} rounded-md text-light">{{ $transaction->type }}</h1>
            </a>
        @endforeach
        @else
        <h1 class="mt-2 text-xs sm:text-sm text-center">anda belum melakukan transaksi apapun.</h1>
        @endif
    </div>
</div>