<?php

namespace Yuges\Package\Traits\Package;

use Illuminate\Support\Collection;

trait HasMigrations
{
    protected string $dir;

    /**
     * @var array{files: array<array-key, string>, load: bool, detect: bool, tag: string, path: string}
     */
    public array $migrations = [
        'files' => [],
        'load' => false,
        'detect' => false,
        'tag' => 'migrations',
        'path' => '/../../database/migrations/',
    ];

    public function hasMigration(string $migration): static
    {
        $this->migrations['files'][] = $migration;

        return $this;
    }

    public function hasMigrations(string|array ...$migrations): static
    {
        $this->migrations['files'] = array_merge(
            $this->migrations['files'],
            Collection::make($migrations)->flatten()->toArray()
        );

        return $this;
    }

    public function loadMigrations(bool $load): static
    {
        $this->migrations['load'] = $load;

        return $this;
    }

    public function detectMigration(bool $detect): static
    {
        $this->migrations['detect'] = $detect;

        return $this;
    }

    public function getMigrationsDir(?string $path = null): string
    {
        $path ??= $this->migrations['path'];

        return $this->dir . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
    }

    public function getMigrationPath(string $path): string
    {
        return $this->getMigrationsDir() . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    public function migrationPath(string $path): string
    {
        return $this->getMigrationPath($path);
    }
}
