<?php

namespace Yuges\Package\Data;

use Yuges\Package\Traits\Package\HasName;
use Yuges\Package\Traits\Package\HasViews;
use Yuges\Package\Traits\Package\HasConfigs;
use Yuges\Package\Traits\Package\HasSeeders;
use Yuges\Package\Traits\Package\HasObservers;
use Yuges\Package\Traits\Package\HasMigrations;

class Package
{
    use
        HasName,
        HasViews,
        HasConfigs,
        HasSeeders,
        HasObservers,
        HasMigrations;

    protected string $dir;

    public static function create(): self
    {
        return new static;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    public function setDir(string $dir): self
    {
        $this->dir = rtrim($dir, DIRECTORY_SEPARATOR);

        return $this;
    }
}
