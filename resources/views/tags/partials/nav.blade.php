@if ( Auth::check() )
<div id="nav-select-tags-div">
    <form role="form"
        action="{{ route('movies.index') }}"
        class="form-horizontal">

    <div class="flex-container">
        <div>
            <button type="submit" class="btn btn-default">
                Filter by Tags:
            </button>
        </div>

        <div style="width:100%">
            <select id="nav-select-tags"
                name="tags[]"
                class="js-example-basic-multiple"
                multiple="multiple"
                style="width:100%"
            >

                @foreach(Auth::user()->tags as $tag)
                <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                    @if ( request()->has('tags') && in_array($tag->id, request()->tags) )
                        selected
                    @endif
                >
                    {{ $tag->name }}
                </option>
                @endforeach

            </select>
        </div>
    </div>

    </form>
</div>
@endif
