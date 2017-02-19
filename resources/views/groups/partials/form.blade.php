<div class="panel panel-default">
    <div class="panel-heading">{{ $group->name }}</div>
    <div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ $route }}">
        {{ csrf_field() }}
        {{ $method or '' }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">Name</label>

            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{ $group->name }}" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
