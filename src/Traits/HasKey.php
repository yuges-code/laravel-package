<?php

namespace Yuges\Package\Traits;

use Yuges\Package\Enums\KeyType;
use Illuminate\Database\Eloquent\Model;
use Yuges\Package\Exceptions\InvalidModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @property-read null|int|string $id
 */
trait HasKey
{
    public static function getKeyTypeEnum(): KeyType
    {
        $model = new static;

        if (! $model instanceof Model) {
            throw InvalidModel::doesNotImplementModel(static::class);
        }

        $classes = class_uses_recursive($model);

        return match (true) {
            in_array(HasUlids::class, $classes, true) => KeyType::Ulid,
            in_array(HasUuids::class, $classes, true) => KeyType::Uuid,
            default => KeyType::BigInteger,
        };
    }
}
