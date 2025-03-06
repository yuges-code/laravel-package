<?php

namespace Yuges\Package\Traits;

use Carbon\Carbon;

/**
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
trait HasTimestamps
{
    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public function getCreatedAtColumn(): ?string
    {
        return static::CREATED_AT;
    }

    public static function getCreatedAtColumnName(): ?string
    {
        return static::CREATED_AT;
    }

    public function getUpdatedAtColumn(): ?string
    {
        return static::UPDATED_AT;
    }

    public function getUpdatedAtColumnName(): ?string
    {
        return static::UPDATED_AT;
    }
}
