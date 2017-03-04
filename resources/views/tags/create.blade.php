@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
$('#select-tags').select2({
  tags: true
});
</script>
@endsection()

@section('content')
<h1>Create New Tag</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

    @include('tags.partials.form')

    </div>
</div>
@endsection
