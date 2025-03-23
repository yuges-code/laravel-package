<?php

namespace Yuges\Package\Traits\Provider;

use Carbon\Carbon;
use Yuges\Package\Data\Package;

trait BootMigrations
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

    protected Package $package;

    protected function bootMigrations(): self
    {
        if ($this->package->migrations['detect']) {
            return $this->detectMigrations();
        }

        $timestamp = Carbon::now();
        $group = $this->generateMigrationGroup();

        foreach ($this->package->migrations['files'] as $file) {
            $file = "{$file}.php";
            $path = $this->package->migrationPath($file);

            if ($this->app->runningInConsole()) {
                $this->publishes([$path => $this->generateMigrationPath($file)], $group);
            }

            if ($this->package->migrations['load']) {
                $this->loadMigrationsFrom($path);
            }
        }

        return $this;
    }

    public function generateMigrationPath(string $file, ?Carbon $datetime = null): string
    {
        $timestamp = $datetime ? $datetime->format('Y_m_d_His') : '0000_00_00_000000';

        return database_path("migrations/{$timestamp}_{$file}");
    }

    public function generateMigrationGroup(): string
    {
        $name = $this->package->shortName();
        $tag = $this->package->migrations['tag'];

        return "{$name}-{$tag}";
    }

    public function detectMigrations(): self
    {
        return $this;
    }
}
