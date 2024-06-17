<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogPostTest extends TestCase
{
    public function testIsTrue(): void
    {
        $blogPost = new BlogPost();
        $datetime = new DateTime();
        $user = new User();

        $blogPost->setTitle('title')
                ->setContent('content')
                ->setSlug('slug')
                ->setCreatedAt($datetime)
                ->setUser($user);

        $this->assertTrue($blogPost->getTitle() === 'title');
        $this->assertTrue($blogPost->getContent() === 'content');
        $this->assertTrue($blogPost->getSlug() === 'slug');
        $this->assertTrue($blogPost->getCreatedAt() === $datetime);
        $this->assertTrue($blogPost->getUser() === $user);
    }

    public function testIsFalse(): void
    {
        $blogPost = new BlogPost();
        $datetime = new DateTime();
        $user = new User();

        $blogPost->setTitle('title')
                ->setContent('content')
                ->setSlug('slug')
                ->setCreatedAt($datetime)
                ->setUser($user);

        $this->assertFalse($blogPost->getTitle() === 'false');
        $this->assertFalse($blogPost->getContent() === 'false');
        $this->assertFalse($blogPost->getSlug() === 'false');
        $this->assertFalse($blogPost->getCreatedAt() === new DateTime());
        $this->assertFalse($blogPost->getUser() === new User);
    }

    public function testIsEmpty(): void
    {
        $blogPost = new BlogPost();

        $this->assertEmpty($blogPost->getTitle());
        $this->assertEmpty($blogPost->getContent());
        $this->assertEmpty($blogPost->getSlug());
        $this->assertEmpty($blogPost->getCreatedAt());
        $this->assertEmpty($blogPost->getUser());
    }
}
