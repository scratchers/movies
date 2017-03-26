<?php

namespace App\Meta;

use App\Movie;
use InvalidArgumentException;
use Exception;
use Carbon\Carbon;

class GuessIt implements MetaService
{
    protected $hostname;
    protected $movie;
    protected $guess;

    public function __construct(Movie &$movie)
    {
        if ( empty($this->hostname = env('GUESSIT_URL')) ) {
            throw new InvalidArgumentException(
                'Environment variable GUESSIT_URL not set.'
            );
        }

        if ( empty($movie->filename) ) {
            throw new InvalidArgumentException(
                'Movie requires a filename to guess.'
            );
        }

        $this->movie =& $movie;

        $this->makeRequest();

        $this->apply();
    }

    public function __get($property)
    {
        if ( $property === 'guess' ) {
            return $this->guess;
        }

        return $this->guess[$property] ?? null;
    }

    protected function makeRequest()
    {
        $query = "{$this->hostname}/?filename={$this->movie->filename}";

        $client = new \GuzzleHttp\Client;

        $response = $client->request('GET', $query);

        if ($status = $response->getStatusCode() != 200) {
            throw new Exception(
                "Guessit host returned status code $status."
            );
        }

        $this->guess = json_decode($response->getBody(), $array = true);
    }

    /**
     * Apply guessed attributes to model with special mappings.
     *
     * @return void
     */
    protected function apply()
    {
        foreach ( $this->guess as $key => $value ) {
            $this->movie->$key = $value;
        }

        if ( empty($this->movie->released_on) && !empty($year = $this->guess['year']) ) {
            $this->movie->released_on = Carbon::createFromDate($year, 1, 1);
        }
    }
}
