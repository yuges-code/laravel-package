<?php

namespace Yuges\Package\Traits\Provider;

use Yuges\Package\Data\Package;
use Illuminate\Database\Eloquent\Model;
use Yuges\Package\Exceptions\InvalidModel;

trait BootObservers
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

    protected Package $package;

    public function bootObservers(): self
    {
        foreach ($this->package->observers as $model => $observer) {
            $model = new $model;

            if (! $model instanceof Model) {
                throw InvalidModel::doesNotImplementModel($model);
            }

            $model::observe($observer);
        }

        return $this;
    }
}
