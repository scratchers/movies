@extends('layouts.app')

@section('content')
<h1>Genres</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @foreach ($genres as $genre)
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ URL::route('genres.show', $genre) }}">
                {{ $genre->name }}
            </a>
        </div>

        <div class="panel-body">
        </div>
    </div>
    @endforeach

    </div>
</div>
@endsection
