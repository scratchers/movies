<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Bookmark This</h4>
</div>

<form class="form-horizontal" role="form" method="POST" action="{{ route('bookmarks.store') }}">
    {{ csrf_field() }}
    <input id="input-path" name="path" type="hidden">

    <div class="modal-body">

        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name</label>

            <div class="col-md-10">
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
