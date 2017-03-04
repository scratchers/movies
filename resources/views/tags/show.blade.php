@extends('layouts.app')

@section('content')
<h1>{{ $tag->name }}</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">{{ $tag->name }}</div>
            <div class="panel-body">

                <label for="name" class="col-md-2 control-label">Name</label>

                <div class="col-md-10">
                    <input class="form-control"
                        type="text"
                        name="name"
                        value="{{ $tag->name }}"
                        readonly
                    />
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
