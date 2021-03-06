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
                        @if ( Auth::check() )
                        <li id="li-nav-tags"><a href="#" onclick="$('#nav-select-tags-div').toggle('blind'); $('#li-nav-tags').toggleClass('active'); return false;">Tags</a></li>
                        @endif
                        <li id="li-nav-genres"><a href="#" onclick="$('#nav-select-genres-div').toggle('blind'); $('#li-nav-genres').toggleClass('active'); return false;">Genres</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                            @unless( empty($bookmark = Auth::user()->bookmarks->first()) )
                            <li><a href="{{ $bookmark->path }}">{{ $bookmark->name }}</a></li>
                            @endunless

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Bookmarks <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @foreach ( Auth::user()->bookmarks as $bookmark)
                                        <li>
                                            <div class="flex-container">
                                                <a class="modal-link" href="{{ route('bookmarks.edit', $bookmark) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ $bookmark->path }}">
                                                    {{ $bookmark->name }}
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a class="modal-link" href="{{ route('bookmarks.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Save New
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('tags.index') }}">Tags</a></li>
                                    <li><a href="{{ route('groups.index') }}">Groups</a></li>
                                    <li><a href="{{ route('genres.index') }}">Genres</a></li>
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

<form role="form"
    action="{{ route('movies.index') }}"
    class="form-horizontal">

    @include('tags.partials.nav')
    @include('genres.partials.nav')

</form>

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

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous"></script>

@yield('scripts')

<script type="text/javascript">
$('.nav-select-tags').select2();
$('.nav-select-genres').select2();
$('.modal-link').click(function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                $('#myModal .modal-content').html(data);
                $('#input-path').val('{{ str_replace(url()->to("/"), '', request()->fullUrl()) }}');
                $('#myModal').modal();
            }
    });
});

function auto_expand_textarea( ta ){ ta.keyup(function(e) {
    while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
        $(this).height($(this).height()+1);
    };
})}
$(function(){
    $('textarea').each(function(){
        var ta = $(this);
        auto_expand_textarea( ta );
    });
});
</script>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

</body>
</html>
