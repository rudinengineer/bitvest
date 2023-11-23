@extends('layouts.main')
@section('container')
<div class="mt-16 p-4">
    <h1 class="text-3xl font-bold text-center text-primary">Pembayaran</h1>
    <div class="mt-4 p-8 bg-gradient-to-tr from-primary to-green-400 rounded-xl shadow-md">
        <div>
            <img src="" alt="" class="w-full h-full aspect-square">
        </div>
    </div>
    <div class="mt-4 sticky flex justify-center items-center">
        <input value="{{ env('APP_NAME') }}" class="referal-code w-full outline-none py-3 border-[1px] border-primary rounded-md text-primary text-center" readonly>
        <div class="referal-copy hidden absolute bg-primary text-light px-2 py-1.5 text-xs rounded-sm">Copied!</div>
    </div>
    <div class="mt-2">
        <button class="w-full py-3 bg-primary font-bold text-light rounded-md">Download</button>
    </div>
</div>
<script>
    $(function() {
        $('.referal-code').on('click', function(e) {
            $('.referal-copy').show()
            $('.referal-code').select()
            document.execCommand("copy")
            setTimeout(() => {
                $('.referal-copy').hide()
            }, 1000);
        })
    })
</script>
@endsection