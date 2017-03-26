<?php

namespace App\Meta;

use App\Movie;

abstract class MetaService
{
    protected $movie;
    protected $hostname;
    protected $attributes = [];

    public function __construct(Movie &$movie) {
        $this->movie =& $movie;

        $this->validate();

        $this->makeRequest();

        $this->apply();
    }

    public function __get($property)
    {
        if ( $property === 'attributes' ) {
            return $this->attributes;
        }

        return $this->attributes[$property] ?? null;
    }

    protected function apply()
    {
        foreach ( $this->attributes as $key => $value ) {
            $this->movie->$key = $value;
        }
    }

    abstract protected function validate();

    abstract protected function makeRequest();
}
