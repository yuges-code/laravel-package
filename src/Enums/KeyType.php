<?php

namespace Yuges\Package\Enums;

enum KeyType: string
{
    case Ulid = 'ulid';
    case Uuid = 'uuid';
    case BigInteger = 'bigInteger';
}
