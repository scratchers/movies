@unless(empty($create))
@can('create', $create['class'])
<li><a href="{{ $create['route'] }}">Create</a></li>
@endcan
@endunless

@unless(empty($edit))
@can('update', $edit['class'])
<li><a href="{{ $edit['route'] }}">{{ $edit['text'] or 'Edit' }}</a></li>
@endcan
@endunless
