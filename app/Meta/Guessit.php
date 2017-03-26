<?php

namespace App\Meta;

use App\Movie;
use InvalidArgumentException;
use Exception;

class Guessit implements MetaService
{
    protected $hostname;
    protected $filename;
    protected $guess;

    public function __construct(Movie &$movie)
    {
        if ( empty($this->hostname = env('GUESSIT_URL')) ) {
            throw new InvalidArgumentException(
                'Environment variable GUESSIT_URL not set.'
            );
        }

        if ( empty($this->filename = $movie->filename) ) {
            throw new InvalidArgumentException(
                'Movie requires a filename to guess.'
            );
        }

        $this->guessit();
    }

    public function __get($property)
    {
        if ( $property === 'guess' ) {
            return $this->guess;
        }

        return $this->guess[$property] ?? null;
    }

    protected function guessit()
    {
        $query = "{$this->hostname}/?filename={$this->filename}";

        $client = new \GuzzleHttp\Client;

        $response = $client->request('GET', $query);

        if ($status = $response->getStatusCode() != 200) {
            throw new Exception(
                "Guessit host returned status code $status."
            );
        }

        $this->guess = json_decode($response->getBody(), $array = true);
    }
}
