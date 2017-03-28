<div class="panel panel-default">
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

        <div class="form-group{{ $errors->has('mnt') ? ' has-error' : '' }}">
            <label for="mnt" class="col-md-2 control-label">mnt</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="mnt" value="{{ $movie->mnt }}" required>
            </div>
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-2 control-label">Title</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" value="{{ $movie->title }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('imdb_id') ? ' has-error' : '' }}">
            <label for="imdb_id" class="col-md-2 control-label">imdb#</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="imdb_id" value="{{ $movie->imdb_id }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-2 control-label">Description</label>
            <div class="col-md-10">
                <textarea class="form-control" name="description">{{ $movie->description }}</textarea>
            </div>
        </div>

        <div class="form-group{{ $errors->has('released_on') ? ' has-error' : '' }}">
            <label for="released_on" class="col-md-2 control-label">Released On</label>
            <div class="col-md-10">
                <input
                    name="released_on"
                    type="date"
                    class="form-control"
                    value="{{ isset($movie->released_on) ? $movie->released_on->toDateString() : '' }}"
                >
            </div>
        </div>

        <div class="form-group{{ $errors->has('runtime_minutes') ? ' has-error' : '' }}">
            <label for="runtime_minutes" class="col-md-2 control-label">Runtime Minutes</label>
            <div class="col-md-10">
                <input
                    name="runtime_minutes"
                    type="number"
                    min="0"
                    step="1"
                    class="form-control"
                    value="{{ $movie->runtime_minutes }}"
                >
            </div>
        </div>

        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            <label for="country" class="col-md-2 control-label">Country</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="country" value="{{ $movie->country }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
            <label for="language" class="col-md-2 control-label">Language</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="language" value="{{ $movie->language }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }}">
            <label for="poster" class="col-md-2 control-label">Poster</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="poster" value="{{ $movie->poster }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
            <label for="rating" class="col-md-2 control-label">Rating</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="rating" value="{{ $movie->rating }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
