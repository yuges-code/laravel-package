<?php

namespace Yuges\Package\Providers;

use ReflectionClass;
use Yuges\Package\Data\Package;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Yuges\Package\Exceptions\InvalidModel;
use Yuges\Package\Traits\Provider\HasPackage;
use Illuminate\Contracts\Foundation\Application;

abstract class PackageServiceProvider extends ServiceProvider
{
    use HasPackage;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->package = $this
            ->createPackage()
            ->setDir($this->getDir());

        $this->configure($this->package);
    }

    abstract public function configure(Package $package): void;

    public function register(): void
    {
        $this->registerConfigs();
    }

    public function registerConfigs(): self
    {
        if (empty($this->package->configs['files'])) {
            return $this;
        }

        foreach ($this->package->configs['files'] as $file) {
            $this->mergeConfigFrom($this->package->configPath("{$file}.php"), $file);
        }

        return $this;
    }

    public function boot(): void
    {
        $this->bootObservers();

        $this->packageBooted();
    }

    public function packageBooted(): void {}

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

    public function getDir(): string
    {
        return dirname((new ReflectionClass(static::class))->getFileName());
    }
}
