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

                {{-- tags --}}
                @if ( Auth::check() )
                <div class="panel-heading">
                    <form role="form"
                        action="{{ route('movies.tags', $movie) }}"
                        method="POST"
                        class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="flex-container">
                            <div style="width:100%">
                                @include('tags.partials.select')
                            </div>

                            <div>
                                <button type="submit" class="btn btn-default">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                @endif

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
