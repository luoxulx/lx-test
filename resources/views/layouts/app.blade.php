<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('/css/home.css') }}" rel="stylesheet" media="all" />

    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />

    <title>{{ config('app.name', '14k.Frankenstein') }}</title>
</head>
<body>
<div id="home">
    @include('layouts.header')
    <div class="container">
        <div class="col-md-9 bann-right">
            @yield('main')
        </div>
        @include('layouts.right')
        <div class="clearfix"></div>
        @include('layouts.foot')
    </div>
</div>
<script type="text/javascript" src="{{ mix('/js/home.js') }}"></script>
</body>
</html>
