<?php

namespace Yuges\Package\Traits\Package;

use Illuminate\Support\Str;

trait HasName
{
    protected string $name;

    public function hasName(string $name): static
    {
        return $this->setName($name);
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function shortName(): string
    {
        return Str::after($this->name, 'laravel-');
    }
}
