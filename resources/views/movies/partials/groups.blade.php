<div class="panel panel-default">
    <div class="panel-heading">Groups</div>
    <div class="panel-body">

        <form role="form"
            action="{{ route('movies.group', $movie) }}"
            method="POST"
            class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <div class="col-md-12">
                    <select id="select-groups"
                        name="groups[]"
                        class="js-example-basic-multiple"
                        multiple="multiple"
                        style="width:100%">

                        @foreach($movie->groups as $group)
                        <option id="group-{{ $group->id }}"
                            value="{{ $group->id }}" selected="true">
                            {{ $group->name }}
                        </option>
                        @endforeach

                        @foreach($groups as $group)
                        <option id="group-{{ $group->id }}"
                            value="{{ $group->id }}">
                            {{ $group->name }}
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
