<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://npm.elemecdn.com/lxgw-wenkai-webfont@1/style.css" rel="stylesheet"/>
        {!! editor_css() !!}
        {!! editor_js() !!}
        @yield('styles')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            <div class="bg-white sticky top-0 z-40">
                @livewire('navigation-menu')
            </div>
            <main>
                {{ $slot }}
            </main>
            <footer class="max-w-7xl mx-auto p-4">
                <div class="flex justify-center px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-right sm:ml-0">
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
            </footer>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
@yield('scripts')
