<?php $genres = App\Genre::all(); ?>

<div id="nav-select-genres-div">
    <form role="form"
        action="{{ route('movies.index') }}"
        class="form-horizontal">

    <div class="flex-container">
        <div>
            <button type="submit" class="btn btn-default">
                With All:
            </button>
        </div>

        <div style="width:100%">
            <select id="nav-select-allgenres"
                name="allgenres[]"
                class="js-example-basic-multiple nav-select-genres"
                multiple="multiple"
                style="width:100%"
            >

                @foreach($genres as $genre)
                <option id="genre-{{ $genre->id }}" value="{{ $genre->id }}"
                    @if ( request()->has('allgenres') && in_array($genre->id, request()->allgenres) )
                        selected
                    @endif
                >
                    {{ $genre->name }}
                </option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="flex-container">
        <div>
            <button type="submit" class="btn btn-default">
                With Any:
            </button>
        </div>

        <div style="width:100%">
            <select id="nav-select-anygenres"
                name="anygenres[]"
                class="js-example-basic-multiple nav-select-genres"
                multiple="multiple"
                style="width:100%"
            >

                @foreach($genres as $genre)
                <option id="genre-{{ $genre->id }}" value="{{ $genre->id }}"
                    @if ( request()->has('anygenres') && in_array($genre->id, request()->anygenres) )
                        selected
                    @endif
                >
                    {{ $genre->name }}
                </option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="flex-container">
        <div>
            <button type="submit" class="btn btn-default">
                Without:
            </button>
        </div>

        <div style="width:100%">
            <select id="nav-select-notgenres"
                name="notgenres[]"
                class="js-example-basic-multiple nav-select-genres"
                multiple="multiple"
                style="width:100%"
            >

                @foreach($genres as $genre)
                <option id="genre-{{ $genre->id }}" value="{{ $genre->id }}"
                    @if ( request()->has('notgenres') && in_array($genre->id, request()->notgenres) )
                        selected
                    @endif
                >
                    {{ $genre->name }}
                </option>
                @endforeach

            </select>
        </div>
    </div>

    </form>
</div>
