<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Bookmark</h4>
</div>

<form class="form-horizontal" role="form" method="POST" action="{{ route('bookmarks.update', $bookmark) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name</label>

            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{ $bookmark->name }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Path</label>

            <div class="col-md-10">
                <input id="bookmark-path" type="text" class="form-control" name="path" value="{{ $bookmark->path }}" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button id="btn-use-current-path" type="button" class="btn btn-default">
                    Use Current
                </button>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>

<input id="input-path" type="hidden">

<script>
$("#btn-use-current-path").click(function(){
    $("#bookmark-path").val(
        $("#input-path").val()
    );
});
</script>
