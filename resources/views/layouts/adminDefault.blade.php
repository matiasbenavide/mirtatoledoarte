<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.adminHead')
</head>
<body class="app default-bg">
    @yield('admin-content')
</body>
<footer>
    {{-- @include('components.footer') --}}
    @include('includes.scripts')
</footer>
</html>
