@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
$('#select-tags').select2({
  tags: true
});
</script>
@endsection()

@section('content')
    <h1>{{ $movie->title }}</h1>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                @if ( Auth::check() )
                <div class="panel-heading">
                    <img src="{{ asset( 'mnt/movies/'.$movie->poster ) }}"></img>
                </div>
                @endif

                <div class="panel-body">
                    @foreach ( $movie->fillable as $fillable )
                        <div class="row">
                            <label class="col-md-2 control-label">{{ $fillable }}</label>

                            <div class="col-md-10">
                                {{ $movie->$fillable }}
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <label class="col-md-2 control-label">
                            Genres
                        </label>

                        <div class="col-md-10">
                            <ul>
                                @foreach($movie->genres as $genre)
                                <li id="genre-{{ $genre->id }}">
                                    {{ $genre->name }}
                                </li>
                                @endforeach
                            </ul>
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

                {{-- tags --}}
                @if ( Auth::check() )
                <div class="panel-footer">
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
            </div>

        </div>
    </div>
@endsection
