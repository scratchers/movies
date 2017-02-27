<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class GroupController extends Controller
{
    /**
     * Creates Group Controller with view data.
     *
     * @return GroupController
     */
    public function __construct()
    {
        View::share('create', [
            'id'    => 'link-create-group',
            'class' => Group::class,
            'route' => route('groups.create'),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $groups = $user->isAdmin() ? Group::all() : $user->groups;

        return view('groups.index', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Group::class);

        $group = new Group;

        $data = [
            'group'  => $group,
            'route'  => route('groups.store'),
        ];

        return view('groups.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Group::class);

        $group = Group::withTrashed()->firstOrCreate($request->except('_method', '_token'));

        if ($group->trashed()) {
            $group->restore();
        }

        return redirect(route('groups.show', $group));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $this->authorize('view', $group);

        return view('groups.show', [
            'group' => $group,
            'edit' => [
                'id'    => "link-edit-group-{$group->id}",
                'class' => Group::class,
                'route' => route('groups.edit', $group),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        $data = [
            'group'  => $group,
            'route'  => route('groups.update', $group),
            'method' => method_field('PUT'),
            'edit' => [
                'id'    => "link-show-group-{$group->id}",
                'class' => Group::class,
                'route' => route('groups.show', $group),
                'text'  => 'Cancel',
            ],
        ];

        return view('groups.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $group->update($request->all());

        return view('groups.show', ['group' => $group]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();

        return redirect(route('groups.index'));
    }
}
