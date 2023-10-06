<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://npm.elemecdn.com/lxgw-wenkai-webfont@1/style.css" rel="stylesheet"/>
    {!! editor_css() !!}
    {!! editor_js() !!}
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
@livewire('posts',['id'=>$id])
@livewireScripts
</body>
</html>
@stack('js')
