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

    protected function makeRequest()
    {
        $query = $this->query();

        $client = new \GuzzleHttp\Client;

        $response = $client->request('GET', $query);

        if ($status = $response->getStatusCode() != 200) {
            throw new Exception(
                __CLASS__." host returned status code $status."
            );
        }

        $this->attributes = json_decode($response->getBody(), $array = true);
    }

    abstract protected function validate();

    abstract protected function query() : string;
}
