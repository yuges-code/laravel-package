<?php

namespace Yuges\Package\Traits\Package;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

trait HasSeeders
{
    protected string $dir;

    /**
     * @var array{classes: array<array-key, class-string<Seeder>>, detect: bool, tag: string, path: string}
     */
    public array $seeders = [
        'classes' => [],
        'detect' => false,
        'tag' => 'seeders',
        'path' => '/../../database/seeders/',
    ];

    /**
     * @param class-string<Seeder> $seeder
     */
    public function hasSeeder(string $seeder): static
    {
        $this->seeders['classes'][] = $seeder;

        return $this;
    }

    public function hasSeeders(string|array ...$seeders): static
    {
        $this->seeders['classes'] = array_merge(
            $this->seeders['classes'],
            Collection::make($seeders)->flatten()->toArray()
        );

        return $this;
    }

    public function detectSeeder(bool $detect): static
    {
        $this->seeders['detect'] = $detect;

        return $this;
    }

    public function getSeedersDir(?string $path = null): string
    {
        $path ??= $this->seeders['path'];

        return $this->dir . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
    }

    public function getSeederPath(string $path): string
    {
        return $this->getSeedersDir() . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    public function seederPath(string $path): string
    {
        return $this->getSeederPath($path);
    }
}
