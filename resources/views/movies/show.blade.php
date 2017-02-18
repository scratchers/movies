@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $movie->basename }}</div>
                <div class="panel-body">

                    <label for="filename" class="col-md-2 control-label">Filename</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="filename" value="{{ $movie->filename }}" readonly required>
                    </div>

                </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
