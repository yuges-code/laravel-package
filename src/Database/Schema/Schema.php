<?php

namespace Yuges\Package\Database\Schema;

use Closure;
use Illuminate\Support\Facades\DB;

class Schema
{
    public static function create(string $table, Closure $callback): void
    {
        self::connection()->create($table, $callback);
    }

    public static function table(string $table, Closure $callback): void
    {
        self::connection()->table($table, $callback);
    }

    public static function hasTable(string $table): bool
    {
        return self::connection()->hasTable($table);
    }

    public static function dropIfExists(string $table): void
    {
        self::connection()->dropIfExists($table);
    }

    public static function connection(?string $name = null): Builder
    {
        $connection = DB::connection($name);

        if (is_null($connection->getSchemaGrammar())) {
            $connection->useDefaultSchemaGrammar();
        }

        return new Builder($connection);
    }
}
