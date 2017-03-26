<?php

namespace App;

use Mimey\MimeTypes;

class MediaType
{
    /**
     * Determines whether the mime of the file is of a specified media supertype
     *
     * @param  string $mediatype
     * @param  string $filename
     * @return bool
     */
    public static function is(string $mediatype, string $filename) : bool
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $mime = (new MimeTypes)->getMimeType($extension);

        // https://stackoverflow.com/a/7168986/4233593
        return $mime[0] === $mediatype[0]
            ? strncmp($mime, $mediatype, strlen($mediatype)) === 0
            : false;

    }
}
