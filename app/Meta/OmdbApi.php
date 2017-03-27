<?php

namespace App\Meta;

use App\Movie;
use InvalidArgumentException;
use Carbon\Carbon;

class OmdbApi extends MetaService
{
    protected function initialize(){
        $this->hostname = 'https://www.omdbapi.com';
    }

    protected function validate(){
        if ( empty($this->movie->imdb_id) && empty($this->movie->title) ) {
            throw new InvalidArgumentException(
                'OMDB API requires a title or an IMDB id.'
            );
        }
    }

    protected function query() : string {
        if ( !empty($this->movie->imdb_id) ) {
            return "{$this->hostname}/?i={$this->movie->imdb_id}";
        }

        return "{$this->hostname}/?t={$this->movie->title}";
    }

    /**
     * Apply attributes to model with special mappings.
     *
     * @return void
     */
    protected function apply()
    {
        parent::apply();

        $this->movie->imdb_id     = $this->attributes['imdbID'] ?? null;
        $this->movie->rating      = $this->attributes['Rated']  ?? null;
        $this->movie->description = $this->attributes['Plot']   ?? null;

        if ( !empty($this->attributes['Released']) ) {
            $this->movie->released_on = new Carbon($this->attributes['Released']);
        }

        if ( !empty($this->attributes['Runtime']) ) {
            $this->movie->runtime_minutes = preg_replace('/[^\d]/', '', $this->attributes['Runtime']);
        }
    }
}
