@extends('layouts.app')

@section('content')
<h1>{{ $tag->name }}</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @include('tags.partials.form')

    @can('delete', $tag)
    <div class="panel panel-default">
        <div class="panel-body flex-container">
            <form role="form"
                action="{{ route('tags.destroy', $tag) }}"
                method="POST"
                class="form-horizontal"
            >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endcan

    </div>
</div>
@endsection
