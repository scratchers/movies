@extends('layouts.app')

@section('content')
<h1>Tags</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @foreach ($tags as $tag)
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ URL::route('tags.show', $tag) }}">
                {{ $tag->name }}
            </a>
        </div>

        <div class="panel-body">
        </div>
    </div>
    @endforeach

</div>
@endsection
