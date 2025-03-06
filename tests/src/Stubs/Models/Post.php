<?php

namespace Yuges\Package\Tests\Stubs\Models;

use Yuges\Package\Traits\HasKey;
use Yuges\Package\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Post extends Model
{
    use
        HasKey,
        HasUuids,
        HasTable;

    protected $table = 'posts';
}
