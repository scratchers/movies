@extends('layouts.app')

@section('content')
<h1>Movies</h1>
<div class="row">
    @foreach ($movies as $movie)
        <div class="col-xs-12 col-sm-6 col-md-3">
            <img src="{{ asset( 'mnt/movies/'.$movie->poster ) }}"></img>
            <p style="word-wrap: break-word">
                <a id="link-movie-{{ $movie->id }}" href="{{ URL::route('movies.show', $movie) }}">
                    {{ $movie->title }}
                </a>
            </p>
        </div>
    @endforeach
</div>
@endsection
