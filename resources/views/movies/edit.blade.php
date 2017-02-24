@extends('layouts.app')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
.flex-container {
    margin: auto;
    display: flex;
    justify-content: space-between;
}
</style>
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
            <div class="panel-body flex-container">

                <select class="js-example-basic-multiple" multiple="multiple" style="width: 50%">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="WY">Wyoming</option>
                </select>

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
