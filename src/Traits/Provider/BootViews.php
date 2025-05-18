<?php

namespace Yuges\Package\Traits\Provider;

use Yuges\Package\Data\Package;

trait BootViews
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

    protected Package $package;

    protected function bootViews(): self
    {
        if (! $this->package->views['has']) {
            return $this;
        }

        $path = $this->package->viewPath();
        $group = $this->generateViewGroup();
        $namespace = $this->package->views['namespace'];

        if ($this->app->runningInConsole()) {
            $this->publishes([$path => $this->generateViewPath($namespace)], $group);
        }

        if ($this->package->views['load']) {
            $this->loadViewsFrom($path, $namespace);
        }

        return $this;
    }

    public function generateViewPath(string $namespace): string
    {
        return resource_path("views/vendor/{$namespace}");
    }

    public function generateViewGroup(): string
    {
        $name = $this->package->shortName();
        $tag = $this->package->views['tag'];

        return "{$name}-{$tag}";
    }
}
