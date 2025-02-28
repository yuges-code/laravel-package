<?php

namespace Yuges\Package\Traits;

use Illuminate\Database\Eloquent\Model;
use Yuges\Package\Exceptions\InvalidModel;

trait HasTable
{
    public static function getTableName(): string
    {
        $model = new static;

        if (! $model instanceof Model) {
            throw InvalidModel::doesNotImplementModel(static::class);
        }

        return $model->getTable();
    }
}
