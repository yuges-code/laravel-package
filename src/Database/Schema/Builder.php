<?php

namespace Yuges\Package\Database\Schema;

use Closure;
use Illuminate\Container\Container;

class Builder extends \Illuminate\Database\Schema\Builder
{
    protected function createBlueprint($table, ?Closure $callback = null)
    {
        $connection = $this->connection;

        if (isset($this->resolver)) {
            return call_user_func($this->resolver, $connection, $table, $callback);
        }

        return Container::getInstance()->make(Blueprint::class, compact('connection', 'table', 'callback'));
    }
}
