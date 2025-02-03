<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('scripts')
</head>
<body>
    @include('partials.header')
    
    <div class="content">
        @yield('content')
    </div>
    
    @include('partials.footer')
</body>
</html>