<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="">
    <meta name="description" content="">
    <meta name="author" content="">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Optional CSS -->
    <link rel="stylesheet" href="{{ mix('/css/home.css') }}">

    <title>@yield('seo_title', config('app.name'))</title>
    <!-- Scripts -->
    <script>
        window.Language = '{{ config('app.locale') }}';

        window.Laravel = {'csrfToken': '{{ csrf_token() }}'}
    </script>
  </head>
  <body>

    <div class="container">
        @include('home.header')
    </div>

    <main role="main" class="container" id="home">
        <div class="row">
            @yield('content')
        </div>
    </main>
    @include('home.footer')

    <!-- Optional JavaScript -->
    <script src="{{ mix('/js/home.js') }}"></script>

  </body>
</html>
