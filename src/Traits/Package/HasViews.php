<?php

namespace Yuges\Package\Traits\Package;

trait HasViews
{
    protected string $dir;

    /**
     * @var array{has: bool, load: bool, tag: string, namespace: ?string, path: string}
     */
    public array $views = [
        'has' => false,
        'load' => false,
        'tag' => 'views',
        'namespace' => null,
        'path' => '/../../resources/views/',
    ];

    public function hasViews(?string $namespace = null): static
    {
        $namespace ??= $this->shortName();

        $this->views['has'] = true;
        $this->views['namespace'] = $namespace;

        return $this;
    }

    public function loadViews(bool $load): static
    {
        $this->views['load'] = $load;

        return $this;
    }

    public function getViewsDir(?string $path = null): string
    {
        $path ??= $this->views['path'];

        return $this->dir . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
    }

    public function viewPath(?string $path = null): string
    {
        return $this->getViewsDir($path);
    }
}
