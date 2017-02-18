<div class="panel panel-default">
    <div class="panel-heading">{{ $movie->basename }}</div>
    <div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ $route }}">
        {{ csrf_field() }}
        {{ $method or '' }}

        <div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
            <label for="filename" class="col-md-2 control-label">Filename</label>

            <div class="col-md-10">
                <input type="text" class="form-control" name="filename" value="{{ $movie->filename }}" required>
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
