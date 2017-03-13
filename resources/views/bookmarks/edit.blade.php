<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Bookmark</h4>
</div>

<div class="modal-body">
    <form
        id="form-update-bookmark"
        class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('bookmarks.update', $bookmark) }}"
    >
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name</label>

            <div class="col-md-10">
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{ $bookmark->name }}"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Path</label>

            <div class="col-md-10">
                <input
                    id="bookmark-path"
                    type="text"
                    class="form-control"
                    name="path" value="{{ $bookmark->path }}"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button id="btn-use-current-path" type="button" class="btn btn-default">
                    Use Current
                </button>
            </div>
        </div>

    </form>
</div>

<div class="modal-footer flex-container">
    <button
        onclick="$('#form-delete-bookmark').submit()"
        class="btn btn-danger"
    >
        Delete
    </button>

    <button
        onclick="$('#form-update-bookmark').submit()"
        class="btn btn-primary"
    >
        Save
    </button>
</div>

<form
    id="form-delete-bookmark"
    role="form"
    action="{{ route('bookmarks.destroy', $bookmark) }}"
    method="POST"
    class="form-horizontal"
>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

<input id="input-path" type="hidden">

<script>
$("#btn-use-current-path").click(function(){
    $("#bookmark-path").val(
        $("#input-path").val()
    );
});
</script>
