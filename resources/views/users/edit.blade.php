@extends('layouts.main')
@section('container')
<div class="w-full mt-16 pb-32 p-4 sm:grid grid-cols-2">
    <div class="hidden sm:flex">
        <img src="{{ asset('/assets/images/profile.png') }}" alt="Profile Image">
    </div>
    <div class="sm:px-10 sm:py-5">
        <div class="w-full flex justify-between items-center">
            <a href="/profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15 6l-6 6l6 6" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-semibold">Profile</h1>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>              
            </div>
        </div>
        <form action="/profile/image" method="post" enctype="multipart/form-data" class="w-full mt-8 grid justify-center">
            @method('post')
            @csrf
            <label for="image" class="sticky flex justify-center items-center cursor-pointer">
                <div class="absolute text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>                  
                </div>
                @if (auth()->user()->image)
                <div>
                    <img src="{{ asset('/storage/images/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->username }}" class="w-24 h-24 rounded-full">
                </div>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                @endif
            </label>
            <input type="file" name="image" id="image" accept="image/*" hidden onchange="$('.btn-upload-image').click()">
            <button type="submit" class="btn-submit btn-upload-image" hidden>Upload</button>
        </form>
        <form action="/profile/edit" method="post" class="mt-8">
            @method('post')
            @csrf
            <div>
                <div>
                    <label for="first_name">Nama Depan</label>
                </div>
                <input type="text" name="first_name" id="first_name" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('first_name') ? old('first_name') : auth()->user()->first_name }}">
            </div>
            <div class="mt-2">
                <div>
                    <label for="last_name">Nama Belakang</label>
                </div>
                <input type="text" name="last_name" id="last_name" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('last_name') ? old('last_name') : auth()->user()->last_name }}">
            </div>
            <div class="mt-2">
                <div>
                    <label for="phone">No. Telp</label>
                </div>
                <input type="number" name="phone" id="phone" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('phone') ? old('phone') : auth()->user()->phone }}">
            </div>
            <div class="mt-2">
                <div>
                    <label for="gender">Jenis Kelamin</label>
                </div>
                <select name="gender" id="gender" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary">
                    <option selected disabled>Pilih jenis kelamin</option>
                    <option value="male" {{ old('gender') && old('gender') === 'male' ? 'selected' : (auth()->user()->gender === 'male' ? 'selected' : '') }}>Laki-Laki</option>
                    <option value="female" {{ old('gender') && old('gender') === 'female' ? 'selected' : (auth()->user()->gender === 'female' ? 'selected' : '') }}>Perempuan</option>
                </select>
            </div>
            <div class="mt-2">
                <div>
                    <label for="birthday">Tanggal Lahir</label>
                </div>
                <input type="date" name="birthday" id="birthday" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary" value="{{ old('birthday') ? old('birthday') : auth()->user()->birthday }}">
            </div>
            <div class="mt-2">
                <div>
                    <label for="bio">Bio</label>
                </div>
                <textarea name="bio" rows="4" id="bio" autocomplete="off" class="w-full px-4 py-3 rounded-md outline-none border-[1px] border-slate-300 transition duration-300 ease-in-out focus:border-primary">{{ old('bio') ? old('bio') : auth()->user()->bio }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-submit w-full flex justify-center items-center py-3 bg-primary font-bold text-light rounded-md"><span>Simpan</span>@include('components.loader')</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('/assets/js/loader.js') }}"></script>
@endsection