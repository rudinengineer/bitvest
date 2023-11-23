<nav class="navbar w-full absolute top-0 left-0 bg-light p-4 shadow-sm flex justify-between items-center border-b-[1px] border-slate-300 z-[50]">
    <div class="sm:w-1/4">
        <a href="/" class="text-2xl font-bold text-primary sm:px-4">{{ env('APP_NAME') }}</a>
    </div>
    <form action="" method="get" class="sm:w-2/4 hidden sm:block">
        <div class="sticky">
            <label for="keyword" class="absolute top-[10px] left-[11px] text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[22px] h-[22px]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>                  
            </label>
            <input type="text" name="keyword" id="keyword" class="w-full py-[10px] rounded-md outline-none px-4 pl-9 border-[1px] border-slate-300" placeholder="Masukkan keyword pencarian..." autocomplete="off">
        </div>
    </form>
    <ul class="sm:w-1/4 hidden sm:flex gap-6 justify-end items-center px-4">
        {{-- <li><button>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>              
        </button></li> --}}
        <li class="transition ease-in-out hover:text-primary sticky"><a href="/referal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>              
        </a></li>
        <li class="group"><button>
            @if (auth()->user() && auth()->user()->image)
            <div>
                <img src="{{ asset('/storage/images/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->username }}" class="w-7 h-7 rounded-full">
            </div>
            @else
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            @endif
        </button>
        @if (auth()->user())
        <?php 
            $referal = \App\Models\Referal::where('code', auth()->user()->referal_code)->get();
            $investasi = \App\Models\Investasi::where('user_id', auth()->user()->id)->get();
        ?>
        <div class="w-[30vw] p-4 bg-light border-[1px] border-slate-300 shadow-sm rounded-md absolute right-6 text-dark hidden group-hover:block">
            <ul>
                <li class="flex gap-2 items-center">
                    @if (auth()->user()->image)
                    <div>
                        <img src="{{ asset('/storage/images/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->username }}" class="w-10 h-10 rounded-full">
                    </div>
                    @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>                      
                    </div>
                    @endif
                    <div>
                        <h1 class="font-bold">{{ auth()->user()->username }}</h1>
                        <h1 class="text-xs">{{ auth()->user()->email }}</h1>
                    </div>
                </li>
            </ul>
            <div class="grid grid-cols-[1.8fr__1fr]">
                <ul class="mt-3 px-1 pr-3 border-r-[1px] border-slate-300">
                    <li class="w-full flex justify-between items-center">
                        <div class="flex gap-1 items-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>  
                            <h1>Saldo</h1>                    
                        </div>
                        <h1>Rp {{ number_format(auth()->user()->saldo, 0, '.', '.') }}</h1>
                    </li>
                    <li class="mt-1 w-full flex justify-between items-center">
                        <div class="flex gap-1 items-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>                                                        
                            <h1>Investasi</h1>                    
                        </div>
                        <h1>{{ $investasi->count() }}</h1>
                    </li>
                    <li class="mt-1 w-full flex justify-between items-center">
                        <div class="flex gap-1 items-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>                              
                            <h1>Referal</h1>                    
                        </div>
                        <h1>{{ $referal->count() }}</h1>
                    </li>
                </ul>
                <ul class="mt-3 px-3">
                    <li><a href="/profile" class="transition ease-in-out hover:text-primary">Profile saya</a></li>
                    <li class="mt-1.5"><a href="/saldo" class="transition ease-in-out hover:text-primary">Saldo saya</a></li>
                    <li class="mt-1.5"><a href="/profile/setting" class="transition ease-in-out hover:text-primary">Pengaturan</a></li>
                    <li class="mt-1.5"><a href="/transaction/history" class="transition ease-in-out hover:text-primary">Riwayat</a></li>
                    <li class="mt-1.5"><button onclick="question('Session akan terhapus', '/auth/logout')" class="transition ease-in-out hover:text-primary">Logout</button></li>
                </ul>
            </div>
        </div>
        </li>
        @else
        <div class="absolute right-6 px-5 py-3 bg-light border-[1px] border-slate-300 shadow-sm rounded-md hidden group-hover:flex">
            <ul>
                <li><a href="/signin" class="transition ease-in-out hover:text-primary">Masuk</a></li>
                <li class="mt-0.5"><a href="/signup" class="transition ease-in-out hover:text-primary">Daftar</a></li>
            </ul>
        </div>
        @endif
    </ul>
    {{-- <button class="sm:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>                 
    </button> --}}
</nav>