<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class MovieController extends Controller
{
    /**
     * Creates Movie Controller with auth middleware.
     *
     * @return MovieController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index', ['movies' => Movie::all()]);
    }

    /**
     * Display a listing of filenames not found in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $this->authorize('create', Movie::class);

        $files  = collect(Storage::disk('movies')->allFiles());
        $movies = Movie::all()->pluck('filename');

        $movies = $files->diff($movies)->transform(function ($filename) {
            $movie = new Movie;

            $movie->filename = $filename;

            return $movie;
        });

        return view('movies.new', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize(Movie::class);

        $movie = new Movie;

        $movie->filename = $request->input('filename', '');

        $data = [
            'movie'  => $movie,
            'route'  => route('movies.store'),
        ];

        return view('movies.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Movie::class);

        $movie = Movie::withTrashed()->firstOrCreate($request->except('_method', '_token'));

        if ($movie->trashed()) {
            $movie->restore();
        }

        return redirect(route('movies.show', $movie));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);

        $data = [
            'movie'  => $movie,
            'route'  => route('movies.update', $movie),
            'method' => method_field('PUT'),
        ];

        return view('movies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $movie->update($request->all());

        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);

        $movie->delete();

        return redirect(route('movies.index'));
    }
}
