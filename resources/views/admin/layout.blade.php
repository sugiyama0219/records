<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <title>アクセスジョブ 管理者画面</title>
        @include('admin.style-sheet')
    </head>
    <body>
        @include('admin.nav')
        <div class='container'>
            @yield('content')
        </div>
    </body>
</html>
