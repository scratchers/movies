@extends('layouts.app')

@section('content')
<h1>Groups</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @foreach ($groups as $group)
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ URL::route('groups.show', $group) }}">
                {{ $group->name }}
            </a>
        </div>

        <div class="panel-body">
        </div>
    </div>
    @endforeach

    </div>
</div>
@endsection
