<?php

namespace Yuges\Package\Exceptions;

use Exception;
use TypeError;
use Illuminate\Database\Eloquent\Model;

class InvalidModel extends Exception
{
    public static function doesNotImplementModel(string $class): TypeError
    {
        $model = Model::class;

        return new TypeError("Model class `{$class}` must implement `{$model}`");
    }
}
