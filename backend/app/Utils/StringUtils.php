<?php

namespace App\Utils;

use Illuminate\Support\Str;

class StringUtils
{
    public static function slugify(string $value, int $numChunks = 4): string
    {
        $slug = Str::of($value)->slug();
        $slug = $slug->explode('-')->take($numChunks)->implode('-');

        return $slug;
    }

    public static function summarize(string $value, $numberOfSentences = 1): string {

        /**
         * Making 'String Object' from 'string' variable $value
         */
        $stringValue = Str::of($value);

        /**
         * Splitting content by sentences and returning the first one.
         */
        $firstSentence = $stringValue->explode('.')->take($numberOfSentences);

        return $firstSentence;
    }

}
