<!DOCTYPE html>
<html dir="ltr" lang="zh-Hant-TW">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Wayne" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CHARTBOT</title>

    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('home/style.css') }}" type="text/css" /> --}}
    @yield('page-style')
</head>

<body>
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
</body>
<script src="{{ asset('home/js/jquery.js') }}"></script>
<script src="{{ asset('home/js/plugins.min.js') }}"></script>

@yield('page-script')

</html>
