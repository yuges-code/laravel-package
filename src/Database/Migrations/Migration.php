<?php

namespace Yuges\Package\Database\Migrations;

use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Interfaces\MigrationInterface;

abstract class Migration extends \Illuminate\Database\Migrations\Migration implements MigrationInterface
{
    /** The name of the migration table. */
    protected ?string $table;

    public function down(): void
    {
        if (! $this->table) {
            return;
        }

        Schema::dropIfExists($this->table);
    }
}
