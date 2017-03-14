<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Auth;
use View;
use App\Http\Requests\CreateTag;

class TagController extends Controller
{
    /**
     * Creates Tag Controller.
     *
     * @return TagController
     */
    public function __construct()
    {
        $this->authorizeResource(Tag::class);

        View::share('create', [
            'id'    => 'link-create-tag',
            'class' => Tag::class,
            'route' => route('tags.create'),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tags' => Auth::User()->tags,
        ];

        return view('tags.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'route'  => route('tags.store'),
        ];

        return view('tags.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTag $request)
    {
        $tag = new Tag([
            'name' => $request->input('name'),
        ]);

        $request->user()->tags()->save($tag);

        return redirect(route('tags.show', $tag));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $data = [
            'tag' => $tag,
            'edit' => [
                'id'     => "link-edit-tag-{$tag->id}",
                'object' => $tag,
                'route'  => route('tags.edit', $tag),
            ],
        ];

        return view('tags.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $data = [
            'tag'    => $tag,
            'route'  => route('tags.update', $tag),
            'method' => method_field('PUT'),
            'edit' => [
                'id'     => "link-show-tag-{$tag->id}",
                'object' => $tag,
                'route'  => route('tags.show', $tag),
                'text'   => 'Cancel',
            ],
        ];

        return view('tags.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());

        return view('tags.show', ['tag' => $tag]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect(route('tags.index'));
    }
}
