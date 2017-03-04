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

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        @if ( $errors->has('name') )
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                {{ $errors->first('name') }}
                            </div>
                        @endif
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
