<?php

namespace Yuges\Package\Providers;

use ReflectionClass;
use Yuges\Package\Data\Package;
use Illuminate\Support\ServiceProvider;
use Yuges\Package\Traits\Provider\BootViews;
use Yuges\Package\Traits\Provider\HasPackage;
use Yuges\Package\Traits\Provider\BootConfigs;
use Yuges\Package\Traits\Provider\BootSeeders;
use Yuges\Package\Traits\Provider\BootObservers;
use Illuminate\Contracts\Foundation\Application;
use Yuges\Package\Traits\Provider\BootMigrations;

abstract class PackageServiceProvider extends ServiceProvider
{
    use
        HasPackage,
        BootViews,
        BootConfigs,
        BootSeeders,
        BootObservers,
        BootMigrations;

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

    public function boot(): void
    {
        $this
            ->bootConfigs()
            ->bootObservers()
            ->bootMigrations()
            ->bootSeeders()
            ->bootViews();

        $this->packageBooted();
    }

    public function packageBooted(): void {}

    public function getDir(): string
    {
        return dirname((new ReflectionClass(static::class))->getFileName());
    }
}
