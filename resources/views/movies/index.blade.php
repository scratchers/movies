@extends('layouts.app')

@section('content')
<div class="container">

    @can('create', App\Movie::class)
    <div class="panel panel-default">
        <div class="panel-body flex-container">
            <a href="{{ route('movies.new') }}" class="btn btn-primary">
                Create New Movie
            </a>
        </div>
    </div>
    @endcan

    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-xs-12 col-sm-6 col-md-3">
                <p style="word-wrap: break-word">
                    <a href="{{ URL::route('movies.show', $movie) }}">
                        {{ $movie->basename }}
                    </a>
                </p>
            </div>
        @endforeach
    </div>

</div>
@endsection
