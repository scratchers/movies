@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
$('#select-tags').select2({
  tags: true
});
</script>
@endsection()

@section('content')
<h1>Create New Tag</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    <div class="panel panel-default">
        <div class="panel-body">

            <form role="form"
                action="{{ route('tags.store') }}"
                method="POST"
                class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-md-12">

                        @include('tags.partials.select')

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    </div>
</div>
@endsection
