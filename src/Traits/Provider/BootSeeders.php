<?php

namespace Yuges\Package\Traits\Provider;

use Carbon\Carbon;
use ReflectionClass;
use Yuges\Package\Data\Package;

trait BootSeeders
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

    protected Package $package;

    protected function bootSeeders(): self
    {
        if ($this->package->seeders['detect']) {
            return $this->detectSeeders();
        }

        $timestamp = Carbon::now();
        $group = $this->generateSeederGroup();

        foreach ($this->package->seeders['classes'] as $class) {
            $class = new ReflectionClass($class)->getShortName();
            $class =  "{$class}.php";
            $path = $this->package->seederPath($class);

            if ($this->app->runningInConsole()) {
                $this->publishes([$path => $this->generateSeederPath($class)], $group);
            }
        }

        return $this;
    }

    public function generateSeederPath(string $file): string
    {
        return database_path("seeders/{$file}");
    }

    public function generateSeederGroup(): string
    {
        $name = $this->package->shortName();
        $tag = $this->package->seeders['tag'];

        return "{$name}-{$tag}";
    }

    public function detectSeeders(): self
    {
        return $this;
    }
}
