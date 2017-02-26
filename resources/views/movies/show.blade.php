@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $movie->basename }}</div>
                <div class="panel-body">

                <div class="row">
                    <label for="filename" class="col-md-2 control-label">Filename</label>

                    <div class="col-md-10">
                        {{ $movie->filename }}
                    </div>
                </div>

                <div class="row">
                    <label for="groups" class="col-md-2 control-label">
                        Groups
                    </label>
                    <div class="col-md-10">
                        <ul>
                            @foreach($movie->groups as $group)
                            <li id="group-{{ $group->id }}">
                                {{ $group->name }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
