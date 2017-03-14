<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use View;

class GenreController extends Controller
{
    /**
     * Creates Genre Controller.
     *
     * @return GenreController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);

        View::share('create', [
            'id'    => 'link-create-genre',
            'class' => Genre::class,
            'route' => route('genres.create'),
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
            'genres' => Genre::all(),
        ];

        return view('genres.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Genre::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Genre::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        $data = [
            'genre' => $genre,
            'edit' => [
                'id'     => "link-edit-genre-{$genre->id}",
                'object' => $genre,
                'route'  => route('genres.edit', $genre),
            ],
        ];

        return view('genres.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        $this->authorize('update', $genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $this->authorize('update', $genre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $this->authorize('delete', $genre);
    }
}
