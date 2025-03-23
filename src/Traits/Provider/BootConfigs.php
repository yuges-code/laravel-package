<?php

namespace Yuges\Package\Traits\Provider;

use Yuges\Package\Data\Package;

trait BootConfigs
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

    protected Package $package;

    public function registerConfigs(): static
    {
        if (empty($this->package->configs['files'])) {
            return $this;
        }

        foreach ($this->package->configs['files'] as $file) {
            $this->mergeConfigFrom($this->package->configPath("{$file}.php"), $file);
        }

        return $this;
    }

    protected function bootConfigs(): static
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }

        $group = $this->generateConfigGroup();

        foreach ($this->package->configs['files'] as $file) {
            $file = "{$file}.php";
            $path = $this->package->configPath($file);

            $this->publishes([$path => $this->generateConfigPath($file)], $group);
        }

        return $this;
    }

    protected function generateConfigPath(string $file): string
    {
        return config_path($file);
    }

    public function generateConfigGroup(): string
    {
        $name = $this->package->shortName();
        $tag = $this->package->configs['tag'];

        return "{$name}-{$tag}";
    }
}
