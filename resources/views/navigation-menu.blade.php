<nav x-data="{ open: false, darkMode: localStorage.getItem('theme') !== 'light' }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    {{-- <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"> --}}
    <div class="px-4 mx-auto max-w-8xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:flex">
                    @if(auth()->user()->role == 'admin')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                    @if(auth()->user()->role == 'user')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link href="{{ route('traks.index') }}" :active="request()->routeIs('traks.index')">
                        {{ __('Traks') }}
                    </x-nav-link>
                    @if(auth()->user()->role == 'admin')
                        <x-nav-link href="{{ route('courses.index') }}" :active="request()->routeIs('courses.index')">
                            {{ __('Courses') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('contents.index') }}" :active="request()->routeIs('contents.index')">
                            {{ __('Contents') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" @click="darkMode = !darkMode; 
                        localStorage.setItem('theme', darkMode ? 'dark' : 'light'); 
                        document.documentElement.classList.toggle('dark', darkMode); 
                        location.reload();" 
                        class="p-2 text-gray-800 rounded-md dark:text-gray-200 focus:outline-none">
                    <i class="fas fa-moon" x-show="!darkMode"></i> <!-- Moon icon for light mode, only shows when darkMode is false -->
                    <i class="fas fa-sun" x-show="darkMode"></i> <!-- Sun icon for dark mode, only shows when darkMode is true -->
                </button>

                <div class="relative ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none">
                                <img class="object-cover rounded-full size-8" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Account Management -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 focus:outline-none focus:text-gray-500">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->role == 'admin')
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
            @if(auth()->user()->role == 'user')
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link href="{{ route('traks.index') }}" :active="request()->routeIs('traks.index')">
                {{ __('Traks') }}
            </x-responsive-nav-link>
            @if(auth()->user()->role == 'admin')
                <x-responsive-nav-link href="{{ route('courses.index') }}" :active="request()->routeIs('courses.index')">
                    {{ __('Courses') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('contents.index') }}" :active="request()->routeIs('contents.index')">
                    {{ __('Contents') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>

<script>
    // Check the theme stored in localStorage
    const savedTheme = localStorage.getItem('theme');
    
    // If the theme is dark in localStorage, apply it directly
    if (savedTheme === 'dark' || !savedTheme) {
        document.documentElement.classList.add('dark');
    } else if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark');
    } else {
        // If there is no preference, set the theme based on system preference (optional)
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
        if (prefersDarkScheme) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
</script>