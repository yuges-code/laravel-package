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

    public function keyMorphs(KeyType $type = KeyType::BigInteger, string $name, ?string $indexName = null): void
    {
        match ($type) {
            KeyType::Ulid => $this->ulidMorphs($name, $indexName),
            KeyType::Uuid => $this->uuidMorphs($name, $indexName),
            KeyType::BigInteger => $this->numericMorphs($name, $indexName),
        };
    }

    public function nullableKeyMorphs(
        KeyType $type = KeyType::BigInteger,
        string $name,
        ?string $indexName = null
    ): void
    {
        match ($type) {
            KeyType::Ulid => $this->nullableUlidMorphs($name, $indexName),
            KeyType::Uuid => $this->nullableUuidMorphs($name, $indexName),
            KeyType::BigInteger => $this->nullableNumericMorphs($name, $indexName),
        };
    }

    public function order(int $default = 1, string $column = 'order'): ColumnDefinition
    {
        return $this->unsignedInteger($column)->default($default)->index();
    }
}
