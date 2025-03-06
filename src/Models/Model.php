<?php

namespace Yuges\Package\Models;

use Yuges\Package\Traits\HasKey;
use Yuges\Package\Traits\HasTable;
use Yuges\Package\Traits\HasTimestamps;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use
        HasKey,
        HasTable,
        HasTimestamps;
}
