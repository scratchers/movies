@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-xs-12 col-sm-6 col-md-3">
                <p style="word-wrap: break-word">
                    {{ $movie->filename }}
                </p>
            </div>
        @endforeach
    </div>
</div>
@endsection