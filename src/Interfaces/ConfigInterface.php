<?php

namespace Yuges\Package\Interfaces;

interface ConfigInterface
{
    public static function getName(): string;

    public static function get(string $key, mixed $default = null): mixed;
}
