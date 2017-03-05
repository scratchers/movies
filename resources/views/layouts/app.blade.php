<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Movies') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css"
        integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU"
        crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('movies.index') }}">
                        {{ config('app.name', 'Movies') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li id="li-nav-tags"><a href="#" onclick="$('#nav-select-tags-div').toggle('blind'); $('#li-nav-tags').toggleClass('active'); return false;">Tags</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                            <li><a href="{{ route('home') }}">Home</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('tags.index') }}">Tags</a></li>
                                    <li><a href="{{ route('groups.index') }}">Groups</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    @include('tags.partials.nav')

<div class="container">

    <ul class="nav admin-edit-nav pull-right">
        @unless(empty($create))
        @can('create', $create['class'])
        <li>
            <a id="{{ $create['id'] }}"
                href="{{ $create['route'] }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </li>
        @endcan
        @endunless

        @unless(empty($edit))
        @can('update', $edit['object'])
        <li>
            <a  id="{{ $edit['id'] }}"
                href="{{ $edit['route'] }}">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
        </li>
        @endcan
        @endunless
    </ul>

    @yield('content')

</div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>

    @yield('scripts')

    <script type="text/javascript">
        $('#nav-select-tags').select2();
    </script>

</body>
</html>
