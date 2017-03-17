<div class="panel panel-default">
    <div class="panel-heading">Genres</div>
    <div class="panel-body">

        <form role="form"
            action="{{ route('movies.genres', $movie) }}"
            method="POST"
            class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <div class="col-md-12">
                    <select id="select-genres"
                        name="genres[]"
                        class="js-example-basic-multiple"
                        multiple="multiple"
                        style="width:100%">

                        @foreach($movie->genres as $genre)
                        <option id="group-{{ $genre->id }}"
                            value="{{ $genre->id }}" selected="true">
                            {{ $genre->name }}
                        </option>
                        @endforeach

                        @foreach($genres as $genre)
                        <option id="group-{{ $genre->id }}"
                            value="{{ $genre->id }}">
                            {{ $genre->name }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning">
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
