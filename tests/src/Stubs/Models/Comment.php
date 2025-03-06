<?php

namespace Yuges\Package\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Comment extends Model
{
    use HasUlids;
}
