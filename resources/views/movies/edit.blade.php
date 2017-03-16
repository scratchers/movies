@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
$('#select-groups').select2();
$('#select-genres').select2();
</script>
@endsection()

@section('content')
<h1>{{ $movie->basename }}</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @include('movies.partials.form')

    @include('movies.partials.groups')

    @include('movies.partials.genres')

    @can('delete', $movie)
    <div class="panel panel-default">
        <div class="panel-body flex-container">
            <form role="form"
                action="{{ route('movies.destroy', $movie) }}"
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
