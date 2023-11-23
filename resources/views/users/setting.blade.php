@extends('layouts.main')
@section('container')
<div class="mt-16 p-4 sm:grid grid-cols-2">
    <div class="hidden sm:flex">
        <img src="{{ asset('/assets/images/account.png') }}" alt="Account Image" class="w-full h-full">
    </div>
    <div class="sm:p-10">
        <h1 class="text-2xl font-bold text-primary text-center">Pengaturan Akun</h1>
        <form action="/profile/setting" method="post" class="mt-4">
            @method('post')
            @csrf
            <div>
                <div>
                    <label for="email">Email address</label>
                </div>
                @error('email')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <input type="email" name="email" id="email" placeholder="example@gmail.com" autocomplete="off" class="w-full outline-none px-4 py-3 rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('email') ? old('email') : auth()->user()->email }}">
            </div>
            <div class="mt-2">
                <div>
                    <label for="old_password">Password lama</label>
                </div>
                @error('old_password')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <input type="password" name="old_password" id="old_password" placeholder="***" autocomplete="off" class="w-full outline-none px-4 py-3 rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary">
            </div>
            <div class="mt-2">
                <div>
                    <label for="new_password">Password baru</label>
                </div>
                <input type="password" name="new_password" id="new_password" placeholder="***" autocomplete="off" class="w-full outline-none px-4 py-3 rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-submit w-full flex justify-center items-center py-3 bg-primary rounded-md font-bold text-light transition ease-in-out hover:bg-opacity-90"><span>Simpan</span>@include('components.loader')</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('/assets/js/loader.js') }}"></script>
@endsection