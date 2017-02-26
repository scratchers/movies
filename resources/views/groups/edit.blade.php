@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        @include('groups.partials.form')

        @can('delete', $group)
        <div class="panel panel-default">
            <div class="panel-body flex-container">
                <form role="form"
                    action="{{ route('groups.destroy', $group) }}"
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
</div>
@endsection
