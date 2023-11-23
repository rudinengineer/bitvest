@extends('layouts.default')
@section('container')
<div class="w-full h-screen grid sm:grid-cols-2 items-center">
    <div class="hidden sm:flex">
        <img src="{{ asset('/assets/images/signin.png') }}" alt="Login Image">
    </div>
    <div class="flex justify-center items-center">
        <div class="w-full sm:w-2/3 p-4">
            <h1 class="text-3xl font-bold">Login</h1>
            <p>masukkan credential akun anda.</p>
            <form action="/auth/signin" method="post" class="mt-4">
                @method('post')
                @csrf
                <div>
                    @error('username')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="sticky">
                        <label for="username" class="text-primary absolute top-[10px] left-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>                      
                        </label>
                        <input type="text" name="username" id="username" placeholder="Username atau email address" class="w-full pl-10 p-3 outline-none rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" autocomplete="off" value="{{ old('username') }}">
                    </div>
                </div>
                <div class="mt-2">
                    @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="sticky">
                        <label for="password" class="text-primary absolute top-[10px] left-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>                                            
                        </label>
                        <input type="password" name="password" id="password" placeholder="Password" class="w-full pl-10 p-3 outline-none rounded-md border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn-submit w-full flex justify-center items-center py-3 bg-primary font-bold text-light rounded-md transition ease-in-out hover:bg-opacity-90"><span>Login</span>@include('components.loader')</button>
                </div>
            </form>
            <div class="mt-4">
                <p>Belum mempunyai akun? <a href="/signup" class="text-primary font-semibold">Daftar</a></p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/assets/js/loader.js') }}"></script>
@endsection