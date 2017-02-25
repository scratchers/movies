@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $group->name }}</div>
                <div class="panel-body">

                    <label for="name" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ $group->name }}" readonly>
                    </div>

                </div>
            </div>

            @can('update', $group)
            <div class="panel panel-default">
                <div class="panel-body flex-container">
                    <a href="{{ route('groups.edit', $group) }}" class="btn btn-warning">
                        Edit
                    </a>
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endsection
