<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UuidGenerator
{
    /**
     * Return a unique model hash.
     */
    public static function generate($model, $column = 'uuid')
    {
        do {
            $uuid = Str::uuid();
        } while ($model::where($column, $uuid)->exists());

        return $uuid;
    }
}
