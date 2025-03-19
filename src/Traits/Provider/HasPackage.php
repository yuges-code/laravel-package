<?php

namespace Yuges\Package\Traits\Provider;

use Yuges\Package\Data\Package;

trait HasPackage
{
    protected Package $package;

    public function getPackage(): Package
    {
        return $this->package;
    }

    public function setPackage(Package $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function createPackage(): Package
    {
        return Package::create();
    }
}
