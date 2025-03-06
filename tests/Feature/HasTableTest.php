<?php

namespace Yuges\Package\Tests\Feature;

use Yuges\Package\Tests\TestCase;
use Yuges\Package\Tests\Stubs\Models\User;
use Yuges\Package\Tests\Stubs\Models\Post;
use Yuges\Package\Tests\Stubs\Models\Comment;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
        $this->assertEquals('posts', Post::getTableName());
        $this->assertEquals('comments', Comment::getTableName());
    }
}
