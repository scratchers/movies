@if ( Auth::check() )
<div id="nav-select-tags-div">

    <div class="flex-container">
        <div>
            <button type="submit" class="btn btn-default">
                With All:
            </button>
        </div>

        <div style="width:100%">
            <select id="nav-select-alltags"
                name="alltags[]"
                class="js-example-basic-multiple nav-select-tags"
                multiple="multiple"
                style="width:100%"
            >

                @foreach(Auth::user()->tags as $tag)
                <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                    @if ( request()->has('alltags') && in_array($tag->id, request()->alltags) )
                        selected
                    @endif
                >
                    {{ $tag->name }}
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
            <select id="nav-select-anytags"
                name="anytags[]"
                class="js-example-basic-multiple nav-select-tags"
                multiple="multiple"
                style="width:100%"
            >

                @foreach(Auth::user()->tags as $tag)
                <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                    @if ( request()->has('anytags') && in_array($tag->id, request()->anytags) )
                        selected
                    @endif
                >
                    {{ $tag->name }}
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
            <select id="nav-select-nottags"
                name="nottags[]"
                class="js-example-basic-multiple nav-select-tags"
                multiple="multiple"
                style="width:100%"
            >

                @foreach(Auth::user()->tags as $tag)
                <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                    @if ( request()->has('nottags') && in_array($tag->id, request()->nottags) )
                        selected
                    @endif
                >
                    {{ $tag->name }}
                </option>
                @endforeach

            </select>
        </div>
    </div>

</div>
@endif
