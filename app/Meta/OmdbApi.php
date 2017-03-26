<?php

namespace App\Meta;

use App\Movie;

class OmdbApi implements MetaService
{
    protected $movie;

    public function __construct(Movie &$movie)
    {
        $this->movie =& $movie;
    }
}
