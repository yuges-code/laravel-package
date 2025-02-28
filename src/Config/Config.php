<?php

namespace Yuges\Package\Config;

use Yuges\Package\Interfaces\ConfigInterface;
use Illuminate\Support\Facades\Config as ConfigFacade;

abstract class Config implements ConfigInterface
{
    const string NAME = '';

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $name = self::getName();

        if (strlen($name)) {
            $name .= '.';
        }

        return ConfigFacade::get($name . $key, $default);
    }
}
