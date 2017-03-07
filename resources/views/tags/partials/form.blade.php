<div class="panel panel-default">
    <div class="panel-body">


        <form role="form"
            action="{{ $route }}"
            method="POST"
            class="form-horizontal">
            {{ csrf_field() }}
            {{ $method or '' }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Name</label>

                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" value="{{ $edit['object']->name or old('name') }}" required>
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
