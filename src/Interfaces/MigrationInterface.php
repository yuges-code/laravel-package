<?php

namespace Yuges\Package\Interfaces;

interface MigrationInterface
{
    public function up(): void;

    public function down(): void;

    public function getConnection();
}
