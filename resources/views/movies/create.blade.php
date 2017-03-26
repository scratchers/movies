@extends('layouts.app')

@section('content')
<h1>{{ $movie->title }}</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @include('movies.partials.form')

    </div>
</div>
@endsection
