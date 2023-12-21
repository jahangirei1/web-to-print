<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web2Print</title>
    @includeIf('includes.styles')
</head>

<body>
    <div class="container-fluid">
        <nav class="row navbar sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand center" href="">Web2Print</a>
                @if (Auth::check())
                    @if (auth()->user()->type == 0 || auth()->user()->type == 1)
                    <a class="navbar-brand center" href="{{ route('admin-dashboard') }}">Dashboard</a>
                    <a class="navbar-brand center" href="{{ route('admin-list') }}">Admins</a>
                    <a class="navbar-brand center" href="{{ route('admin-users-list') }}">Users</a>
                    <a class="navbar-brand center" href="{{ route('admin-profile') }}">Profile</a>
                    <a class="navbar-brand center" href="{{ route('admin-logout') }}">Log Out</a>
                    @endif
                @endif
            </div>
        </nav>

        @yield('content')
    </div>

    @includeIf('includes.scripts')
</body>

</html>
