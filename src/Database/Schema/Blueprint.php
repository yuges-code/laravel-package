<?php

namespace Yuges\Package\Database\Schema;

use Yuges\Package\Enums\KeyType;
use Illuminate\Database\Schema\ColumnDefinition;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
    public function key(KeyType $type = KeyType::BigInteger, string $column = 'id'): ColumnDefinition
    {
        return match ($type) {
            KeyType::Ulid => $this->ulid($column)->primary(),
            KeyType::Uuid => $this->uuid($column)->primary(),
            KeyType::BigInteger => $this->bigIncrements($column),
        };
    }
}
