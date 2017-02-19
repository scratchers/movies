@extends('layouts.app')

@section('content')
<div class="container">
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
        @endforeach
    </div>
</div>
@endsection
