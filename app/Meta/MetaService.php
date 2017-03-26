<?php

namespace App\Meta;

use App\Movie;

interface MetaService
{
    public function __construct(Movie &$movie);
}
