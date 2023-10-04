<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} {{$article->title}} - {{$article->subtitle}}</title>
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
@livewire('posts',['id'=>$article->id])
@livewireScripts
</body>
</html>
