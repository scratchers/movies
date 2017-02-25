@extends('layouts.app')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection()

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
$('select').select2();
</script>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        @include('movies.partials.form')

        @can('delete', $movie)
        <div class="panel panel-default">
            <div class="panel-body">

                <form role="form"
                    action="{{ route('movies.group', $movie) }}"
                    method="POST"
                    class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="groups[]"
                                class="js-example-basic-multiple"
                                multiple="multiple"
                                style="width:100%">
                                <option value="1">Admin</option>
                                <option value="2">Grown Ups</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning">
                                Save
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

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
</div>
@endsection
