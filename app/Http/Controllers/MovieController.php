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
        $data = [
            'movies' => Movie::all(),
        ];

        return view('movies.index', $data);
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

        $files  = $files->diff($movies)->transform(function ($item) {
            $file = new stdClass;

            $file->name = $item;

            $file->base = basename($item);

            return $file;
        });

        $data = [
            'files' => $files,
        ];

        return view('movies.new', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize(Movie::class);

        $file = new stdClass;

        $file->name = $request->input('filename', '');

        $file->base = basename($file->name);

        $data = [
            'file' => $file,
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

        Movie::create($request->all());

        return redirect(route('movies.index'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
