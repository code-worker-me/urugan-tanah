<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-blue-100/90 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="p-1.5 rounded-xl bg-gradient-to-tr from-blue-700 via-blue-600 to-red-600 shadow-md shadow-blue-900/10 group-hover:scale-105 transition-transform duration-200">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-auto object-contain rounded-lg bg-white p-0.5" />
                        </div>
                        <span class="hidden sm:inline-block font-black text-blue-950 tracking-tight text-lg group-hover:text-blue-700 transition-colors">
                            URUGAN<span class="text-red-600">TANAH</span>
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:space-x-2">
                    @can('view-dashboard')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-nav-link>
                    @endcan

                    @can('kantor')
                        <x-nav-link :href="route('user-manage.index')" :active="request()->routeIs('user-manage.index')">
                            {{ __('User Management') }}
                        </x-nav-link>
                    @endcan

                    <!-- <x-nav-link :href="route('jadwal.index')" :active="request()->routeIs('jadwal.index')">
                        {{ __('Jadwal Truk') }}
                    </x-nav-link> -->
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2.5 px-3.5 py-1.5 border border-blue-200/80 text-sm leading-4 font-bold rounded-full text-blue-950 bg-blue-50/60 hover:bg-blue-100/70 hover:border-blue-300 focus:outline-none transition ease-in-out duration-150 shadow-2xs">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-blue-700 to-blue-600 text-white flex items-center justify-center text-xs font-black shadow-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-xs font-bold text-blue-950 leading-tight">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] font-semibold text-slate-500 capitalize leading-tight">{{ Auth::user()->role ?? 'User' }}</span>
                            </div>

                            <div class="ms-1 text-blue-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-100 bg-slate-50/50">
                            <p class="text-xs font-bold text-blue-950">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] font-medium text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 text-slate-700 hover:text-blue-700 font-semibold">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="flex items-center gap-2 text-red-600 hover:bg-red-50 font-bold" onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-blue-900 hover:text-blue-950 hover:bg-blue-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-blue-100 shadow-xl">
        <div class="pt-2 pb-3 space-y-1">
            @can('view-dashboard')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            @endcan

            @can('kantor')
                <x-responsive-nav-link :href="route('user-manage.index')" :active="request()->routeIs('user-manage.index')">
                    {{ __('User Management') }}
                </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link :href="route('jadwal.index')" :active="request()->routeIs('jadwal.index')">
                {{ __('Jadwal Truk') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-slate-100 bg-slate-50/60">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-700 to-blue-600 text-white flex items-center justify-center font-extrabold text-sm shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-base text-blue-950">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-red-600 font-bold" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>