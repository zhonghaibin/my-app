<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <script src="//cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
    {!! editor_css() !!}
    {!! editor_js() !!}
    {!! editor_preview_init() !!}
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
<div class="overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hidden lg:block fixed z-20  top-[3.8125rem]  right-auto w-[14rem] pb-10 pr-2 overflow-y-auto max-h-full">
            <nav id="nav" class="lg:text-sm lg:leading-6 relative ">
                <div class="sticky top-0 -ml-0.5 pointer-events-none">
                    <div class="h-8 bg-gradient-to-b from-white dark:from-slate-900"></div>
                </div>
                <ul>
                    @foreach($articles as $item)
                        <li><a class="group flex items-center   lg:leading-6  p-2 hover:text-orange-600 text-lg
                        {{$item->id == request()->route('id') ?"text-orange-600":"text-black"}}"
                               href="{{route('posts',$item->id)}}"> {{$item->title}} - {{$item->subtitle}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="lg:pl-[16rem]">
            <header id="header" class="relative z-20">
                <div>
                    <div class="flex items-center pt-2">
                        <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                            <span class="truncate"> {{$article->title}} - {{$article->subtitle}}</span>
                        </h1>
                    </div>
                </div>
            </header>
            <main class="max-w-4xl mx-auto relative z-20 pt-10 xl:max-w-none text-black break-words w-full whitespace-normal">
                <div id="editormd_id">
                    <textarea> {!!$article->feeds->content!!}</textarea>
                </div>
            </main>
            <footer class="text-sm leading-6 mt-16">
                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

</body>
</html>
