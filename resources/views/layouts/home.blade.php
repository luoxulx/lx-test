<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'LNMPA BLOG') }}</title>
    <meta name="author" content="Jason.Roy">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS &&  Custom styles for this template -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
<div id="home">
    <!-- header Nav -->
    @include('layouts.nav')
    <main>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </main>
    <!-- Navigation -->
    <!-- Bootstrap Footer -->
    @include('layouts.footer')
</div>
    <!-- Bootstrap core JavaScript &&  Custom JavaScript for this template -->
    <script src="{{ asset('js/home.js') }}" defer></script>
</body>
</html>
