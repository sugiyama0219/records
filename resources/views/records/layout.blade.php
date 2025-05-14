<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <!-- CSRF Token -->
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <title>アクセスジョブ</title>
        @include('records.style-sheet')
    </head>
    <body>
        @include('records.nav')
        <div class='container'>
            @yield('content')
        </div>
    </body>
</html>
