<?php

namespace Yuges\Package\Traits\Package;

trait HasConfigs
{
    protected string $dir;

    public array $configs = [
        'files' => [],
        'path' => '/../../config/',
    ];

    public function hasConfig(?string $config = null): static
    {
        $config ??= $this->shortName();

        $this->configs['files'][] = $config;

        return $this;
    }

    public function hasConfigs(string ...$configs): static
    {
        $this->configs['files'] = array_merge($this->configs['files'], $configs);

        return $this;
    }

    public function getConfigsDir(?string $path = null): string
    {
        $path ??= $this->configs['path'];

        return $this->dir . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
    }

    public function getConfigPath(string $path): string
    {
        return $this->getConfigsDir() . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    public function configPath(string $path): string
    {
        return $this->getConfigPath($path);
    }
}
