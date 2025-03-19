<?php

namespace Yuges\Package\Data;

use Yuges\Package\Traits\Package\HasConfigs;

class Package
{
    use HasConfigs;

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
