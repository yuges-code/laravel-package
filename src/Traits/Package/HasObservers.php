<?php

namespace Yuges\Package\Traits\Package;

trait HasObservers
{
    /**
     * @var array<class-string<\Illuminate\Database\Eloquent\Model>, class-string>
     */
    public array $observers = [];

    public function hasObserver(string $model, string $observer): static
    {
        $this->observers[$model] = $observer;

        return $this;
    }

    public function hasObservers(array $observers): static
    {
        $this->observers = array_merge($this->observers, $observers);

        return $this;
    }
}
