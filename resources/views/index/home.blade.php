<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<div class="bg-white sticky top-0 z-40">
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="/" class="content-title flex align-middle text-gray-800 text-3xl justify-center  items-center relative">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <form method="get">
                        <div class="hidden w-full lg:flex">
                            <div>
                                <input placeholder="Search" name="keyword" value="{{$_GET['keyword'] ?? ''}}" maxlength="64" type="search" class="block w-full rounded-md border-0 py-1.5  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                            </div>
                            <div>
                                <button type="submit" class="hidden w-full lg:flex items-center text-sm leading-6 text-slate-400 shadow-sm py-1.5 pl-2  hover:ring-slate-300 dark:bg-slate-800 dark:highlight-white/5 dark:hover:bg-slate-700">
                                    <svg width="24" height="24" fill="none" aria-hidden="true" class="flex-none">
                                        <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> </path>
                                        <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    @if (Route::has('login'))
                        @auth
                            <!-- Teams Dropdown -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="ml-3 relative">
                                    <x-dropdown align="right" width="60">
                                        <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                    {{ __('Team Settings') }}
                                                </x-dropdown-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                                        {{ __('Create New Team') }}
                                                    </x-dropdown-link>
                                                @endcan

                                                <!-- Team Switcher -->
                                                @if (Auth::user()->allTeams()->count() > 1)
                                                    <div class="border-t border-gray-200"></div>

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Switch Teams') }}
                                                    </div>

                                                    @foreach (Auth::user()->allTeams() as $team)
                                                        <x-switchable-team :team="$team" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @endif

                            <!-- Settings Dropdown -->
                            <div class="relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>

                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-dropdown-link href="{{ route('logout') }}"
                                                             @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 ml-2">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-2 font-semibold text-gray-600">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1 pl-4">
                <form method="get" class="w-full flex">
                    <div class='w-full'>
                        <input placeholder="Search" name="keyword" value="{{$_GET['keyword'] ?? ''}}" maxlength="64" type="search" class="block w-full rounded-md border-0 py-1.5  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                    </div>
                    <div>
                        <button type="submit" class="w-full lg:flex items-center text-sm leading-6 text-slate-400 shadow-sm py-1.5 pl-2 pr-3 hover:ring-slate-300 dark:bg-slate-800 dark:highlight-white/5 dark:hover:bg-slate-700">
                            <svg width="24" height="24" fill="none" aria-hidden="true" class="mr-3 flex-none">
                                <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> </path>
                                <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            @if (Route::has('login'))
                @auth
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                            @endif

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                    {{ __('API Tokens') }}
                                </x-responsive-nav-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-responsive-nav-link href="{{ route('logout') }}"
                                                       @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                    {{ __('Team Settings') }}
                                </x-responsive-nav-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                        {{ __('Create New Team') }}
                                    </x-responsive-nav-link>
                                @endcan

                                <!-- Team Switcher -->
                                @if (Auth::user()->allTeams()->count() > 1)
                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                @else
                    <x-responsive-nav-link href="{{ route('login') }}">{{ __('Login') }}</x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link href="{{ route('register') }}">{{ __('Register') }}</x-responsive-nav-link>
                    @endif
                @endauth
             @endif
        </div>

    </nav>
</div>
<div class="relative  sm:justify-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    <div class="max-w-7xl mx-auto p-4 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 w-full">
            @forelse($articles as $article)
                <a href="{{route('posts',$article->id)}}"
                   class="scale-100 bg-white from-gray-700/50 via-transparent  shadow-2xl shadow-gray-500/20 flex  transition-all duration-250">
                    <div class="text-sm font-mon w-full rounded-t-lg">
                        <div class="flex items-center justify-center rounded-t-lg">
                            <img src="{{$article->cover}}" class="object-cover object-center h-40 w-full rounded-t-lg">
                        </div>
                        <div class="p-3 subpixel-antialiased">
                            <div class="w-full flex justify-between items-center leading-tight">
                                <div class="text-gray-800 truncate">  {{$article->title}} - {{$article->subtitle}}</div>
                                <div
                                    class="text-sm text-gray-600">{{$article->feeds->created_at->format('Y/m/d')}}</div>
                            </div>
                            <p class="mt-2 text-slate-600 leading-relaxed text-xs line-clamp-2 h-10">
                                {{$article->description}}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <span class="justify-center text-center col-span-4 p-3">暂无数据</span>
            @endforelse

        </div>

        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                <a href="https://github.com/zhonghaibin/my-app" class="font-semibold text-gray-600 flex">
                    <svg viewBox="0 0 16 16" class="w-4 h-4" fill="currentColor" aria-hidden="true">
                        <path
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                    </svg>
                    <div class="pl-2"> GitHub</div>
                </a>
            </div>
            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
@livewireScripts
</body>
</html>
