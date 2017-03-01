@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
$('#select-tags').select2({
  tags: true
});
</script>
@endsection()

@section('content')
    <h1>{{ $movie->basename }}</h1>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <form role="form"
                        action="{{ route('movies.tags', $movie) }}"
                        method="POST"
                        class="form-horizontal">
                        {{ csrf_field() }}

                        @if ( Auth::check() )
                            <button type="submit" class="btn btn-default pull-right">
                                Save
                            </button>
                        @endif

                        @include('tags.partials.select')
                    </form>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-2 control-label">Filename</label>

                        <div class="col-md-10">
                            {{ $movie->filename }}
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-md-2 control-label">
                            Groups
                        </label>

                        <div class="col-md-10">
                            <ul>
                                @foreach($movie->groups as $group)
                                <li id="group-{{ $group->id }}">
                                    {{ $group->name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
