<?php

namespace Yuges\Package\Tests\Feature;

use Yuges\Package\Enums\KeyType;
use Yuges\Package\Tests\TestCase;
use Yuges\Package\Tests\Stubs\Models\User;
use Yuges\Package\Tests\Stubs\Models\Post;
use Yuges\Package\Tests\Stubs\Models\Comment;

class HasKeyTest extends TestCase
{
    public function testGettingKeyType()
    {
        $this->assertEquals(KeyType::Uuid, Post::getKeyTypeEnum());
        $this->assertEquals(KeyType::Ulid, Comment::getKeyTypeEnum());
        $this->assertEquals(KeyType::BigInteger, User::getKeyTypeEnum());
    }
}
