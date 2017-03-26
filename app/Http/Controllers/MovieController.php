<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Policies\MoviePolicy;
use Illuminate\Support\Facades\Auth;
use App\Group;
use View;
use App\Tag;
use App\Genre;
use App\Guessit;
use Carbon\Carbon;
use App\MediaType;

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

        View::share('create', [
            'id'    => 'link-create-movie',
            'class' => Movie::class,
            'route' => route('movies.new'),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = Movie::queryBuilder();

        if ( $request->has('alltags') ) {
            $movies->allTagged($request->alltags);
        }

        if ( $request->has('anytags') ) {
            $movies->anyTagged($request->anytags);
        }

        if ( $request->has('nottags') ) {
            $movies->notTagged($request->nottags);
        }

        if ( $request->has('allgenres') ) {
            $movies->allGenres($request->allgenres);
        }

        if ( $request->has('anygenres') ) {
            $movies->anyGenres($request->anygenres);
        }

        if ( $request->has('notgenres') ) {
            $movies->notGenres($request->notgenres);
        }

        return view('movies.index', ['movies' => $movies->get()]);
    }

    /**
     * Display a listing of filenames not found in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $this->authorize('create', Movie::class);

        $files = collect(Storage::disk('movies')->allFiles());

        $files = $files->filter(function ($file) {
            return MediaType::is('video', $file);
        });

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

        $this->guessit($movie);

        $data = [
            'movie'  => $movie,
            'route'  => route('movies.store'),
        ];

        return view('movies.create', $data);
    }

    /**
     * Guess movie metadata.
     *
     * @param  \App\Movie
     * @return void
     */
    protected function guessit(Movie &$movie)
    {
        if ( !empty(env('GUESSIT_URL')) ) {
            $guess = new Guessit($movie);

            $movie->title = $guess->title;

            if ( !empty($year = $guess->year) ) {
                $movie->released_on = Carbon::createFromDate($year, 1, 1);
            }
        }
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

        $input['filename'] = $request->input('filename');
        $input['mnt'] = 'movies';

        $movie = Movie::withTrashed()->firstOrCreate($input);

        if ($movie->trashed()) {
            $movie->restore();
        }

        $movie->update($request->except('_method', '_token'));

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
        if ( $movie->hasGroups() ) {
            $this->authorize('view', $movie);
        }

        $data = [
            'movie' => $movie,
            'edit' => [
                'id'     => "link-edit-movie-{$movie->id}",
                'object' => $movie,
                'route'  => route('movies.edit', $movie),
            ],
        ];

        if ( Auth::check() ) {
            $tags = Auth::User()->tags;
            $data['tags']  = $tags->diff($movie->tags);
            $movie->tags   = $movie->tags->intersect($tags);
            $data['movie'] = $movie;
        }

        return view('movies.show', $data);
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

        $groups = Group::all()->diff($movie->groups);

        $genres = Genre::all()->diff($movie->genres);

        $data = [
            'movie'  => $movie,
            'route'  => route('movies.update', $movie),
            'method' => method_field('PUT'),
            'groups' => $groups,
            'genres' => $genres,
            'edit' => [
                'id'     => "link-show-movie-{$movie->id}",
                'object' => $movie,
                'route'  => route('movies.show', $movie),
                'text'   => 'Cancel',
            ]
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

    /**
     * Synchronize a movie's groups.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function group(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $groups = Group::find($request->input('groups'));

        $movie->groups()->sync($groups ?? []);

        return redirect(route('movies.show', ['movie' => $movie]));
    }

    /**
     * Synchronize a user's movie tags.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function tags(Request $request, Movie $movie)
    {
        $user = $request->user();

        $tags = collect($request->input('tags'));

        $tags->transform(function($tag) use ($user){
            if ( !is_numeric($tag) ) {
                return (Tag::firstOrCreate([
                    'name' => $tag,
                    'created_by_user_id' => $user->id,
                ]))->id;
            }
            return $tag;
        });

        $allTags = $user->tags;

        $tags = $allTags->find($tags->toArray());

        $movie->tags()->detach($allTags);

        $movie->tags()->attach($tags);

        return redirect(route('movies.show', compact('movie')));
    }

    /**
     * Synchronize a movie's genres.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function genres(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $movie->genres()->sync($request->input('genres') ?? []);

        return redirect(route('movies.show', compact('movie')));
    }
}
