@extends('layouts.main')
@section('container')
<div class="w-full mt-16 sm:mt-0 sm:h-screen">
    <div class="w-full sm:h-full p-4 sm:p-0 grid sm:grid-cols-2">
        <div class="w-full sm:h-full grid items-center sm:p-20">
            <div>
                <div>
                    <h1 class="text-3xl font-bold text-center">Undang Teman</h1>
                    <p class="text-center">undang teman anda untuk mendaftar di aplikasi dan dapatkan keuntungan!</p>
                </div>
                <div class="mt-4 sticky">
                    <input readonly placeholder="Kode Referal" value="{{ env('APP_URL') }}/signup?ref={{ auth()->user()->referal_code }}" class="referal-code w-full py-3 rounded-md outline-none border-[1px] border-primary text-primary font-semibold text-center">
                    <div class="referal-copy absolute bg-light right-3 top-2 text-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                            <title>copy</title>
                        </svg>                  
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="w-full py-[14px] rounded-md bg-primary font-bold text-light">Undang Teman</button>
                </div>
            </div>
        </div>
        <div class="sm:mt-16 sm:border-l-[1px] border-slate-300 sm:px-8">
            <div class="mt-8">
                <h1 class="text-xl font-bold">Riwayat undangan</h1>
                <div class="mt-4">
                    @if ($histories->count())
                    @foreach ($histories as $history)
                    <div class="mt-1 w-full border-[1px] border-slate-300 px-3 py-2 flex justify-between items-center rounded-md">
                        <div class="flex gap-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>                              
                            </div>
                            <div>
                                <h1 class="font-bold">{{ $history->user->username }}</h1>
                                <h1 class="text-xs">{{ $history->created_at->format('d-m-Y') }}</h1>
                            </div>
                        </div>
                        <h1 class="bg-primary px-3 py-1.5 rounded-md text-light font-semibold text-xs">+{{ number_format($history->total, 0, '.',' .') }}</h1>
                    </div>
                    @endforeach
                    @else
                        <h1 class="text-center font-semibold">anda belum mengundang siapapun.</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.referal-copy').on('click', function() {
            $('.referal-code').select()
            document.execCommand("copy")

        })
    })
</script>
@endsection