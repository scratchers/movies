<?php

namespace App\Meta;

use App\Movie;
use Exception;

abstract class MetaService
{
    protected $movie;
    protected $hostname;
    protected $attributes = [];

    public function __construct(Movie &$movie) {
        $this->movie =& $movie;

        $this->initialize();

        $this->validate();

        $this->request();

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
            $key = snake_case($key);
            $this->movie->$key = $value;
        }
    }

    protected function request()
    {
        $query = $this->query();

        $client = new \GuzzleHttp\Client;

        $response = $client->request('GET', $query);

        $status = $response->getStatusCode();

        if ($status != 200) {
            throw new Exception(
                static::class." host returned status code $status."
            );
        }

        $this->attributes = json_decode($response->getBody(), $array = true);
    }

    abstract protected function initialize();

    abstract protected function validate();

    abstract protected function query() : string;
}
