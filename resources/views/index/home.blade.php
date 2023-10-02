<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <div class="bg-white sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="content-title flex align-middle text-gray-800 text-3xl">
                                <x-application-mark class="block h-9 w-auto" />
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center sm:ml-6 ml-3 relative">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600">  {{ __('Dashboard') }}</a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-gray-600">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600">{{ __('Register') }}</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="relative  sm:justify-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-4 lg:p-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 w-full">
                    @forelse($articles as $article)
                        <a href="{{route('posts',$article->id)}}" class="scale-100 bg-white from-gray-700/50 via-transparent  shadow-2xl shadow-gray-500/20 flex  transition-all duration-250">
                            <div class="text-sm font-mon w-full">
                                <div class="flex items-center justify-center">
                                    <img  src="{{$article->cover}}"  class="object-cover object-center h-40 w-full rounded-t-lg">
                                </div>
                                <div class="p-3 subpixel-antialiased">
                                    <div class="w-full flex justify-between items-center leading-tight">
                                        <div class="text-gray-800 truncate">  {{$article->title}} - {{$article->subtitle}}</div>
                                        <div class="text-sm text-gray-600">{{$article->feeds->created_at->format('Y/m/d')}}</div>
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
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
