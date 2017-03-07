<select id="select-tags"
    name="tags[]"
    class="js-example-basic-multiple"
    multiple="multiple"
    style="width:100%">

    @unless( empty($movie) )
    @foreach($movie->tags as $tag)
    <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}" selected="true">
        {{ $tag->name }}
    </option>
    @endforeach

    @foreach($tags as $tag)
    <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
        {{ $tag->name }}
    </option>
    @endforeach
    @endunless

</select>
