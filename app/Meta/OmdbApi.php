<?php

namespace App\Meta;

use App\Movie;
use InvalidArgumentException;

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
}
