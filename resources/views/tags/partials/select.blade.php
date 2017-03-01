<select id="select-tags"
    name="tags[]"
    class="js-example-basic-multiple"
    multiple="multiple"
    style="width:100%">

    @unless( empty($tags) )
    @foreach($tags as $tag)
    <option id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
        {{ $tag->name }}
    </option>
    @endforeach
    @endunless

</select>
