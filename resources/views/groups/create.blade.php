@extends('layouts.app')

@section('content')
<h1>Create New Group</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @include('groups.partials.form')

    </div>
</div>
@endsection
