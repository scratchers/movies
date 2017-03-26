<?php

namespace App\Meta;

use App\Movie;
use InvalidArgumentException;
use Exception;
use Carbon\Carbon;

class GuessIt extends MetaService
{
    public function validate()
    {
        if ( empty($this->hostname = env('GUESSIT_URL')) ) {
            throw new InvalidArgumentException(
                'Environment variable GUESSIT_URL not set.'
            );
        }

        if ( empty($this->movie->filename) ) {
            throw new InvalidArgumentException(
                'Movie requires a filename to guess.'
            );
        }
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

        $this->attributes = json_decode($response->getBody(), $array = true);
    }

    /**
     * Apply guessed attributes to model with special mappings.
     *
     * @return void
     */
    protected function apply()
    {
        parent::apply();

        if ( empty($this->movie->released_on) && !empty($year = $this->attributes['year']) ) {
            $this->movie->released_on = Carbon::createFromDate($year, 1, 1);
        }
    }
}
