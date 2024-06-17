<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Paint;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testIsTrue(): void
    {
        $comment = new Comment();
        $datetime = new DateTime();
        $paint = new Paint();
        $blogPost = new BlogPost();

        $comment->setAuthor('author')
                ->setEmail('true@test.com')
                ->setContent('content')
                ->setCreatedAt($datetime)
                ->setPaint($paint)
                ->setBlogPost($blogPost);

        $this->assertTrue($comment->getAuthor() === 'author');
        $this->assertTrue($comment->getEmail() === 'true@test.com');
        $this->assertTrue($comment->getContent() === 'content');
        $this->assertTrue($comment->getCreatedAt() === $datetime);
        $this->assertTrue($comment->getPaint() === $paint);
        $this->assertTrue($comment->getBlogPost() === $blogPost);
    }

    public function testIsFalse(): void
    {
        $comment = new Comment();
        $datetime = new DateTime();
        $paint = new Paint();
        $blogPost = new BlogPost();

        $comment->setAuthor('author')
                ->setEmail('true@test.com')
                ->setContent('content')
                ->setCreatedAt($datetime)
                ->setPaint($paint)
                ->setBlogPost($blogPost);

        $this->assertFalse($comment->getAuthor() === 'false');
        $this->assertFalse($comment->getEmail() === 'false@test.com');
        $this->assertFalse($comment->getContent() === 'false');
        $this->assertFalse($comment->getCreatedAt() === new DateTime());
        $this->assertFalse($comment->getPaint() === new Paint);
        $this->assertFalse($comment->getBlogPost() === new BlogPost);
    }

    public function testIsEmpty(): void
    {
        $comment = new Comment();

        $this->assertEmpty($comment->getAuthor());
        $this->assertEmpty($comment->getEmail());
        $this->assertEmpty($comment->getContent());
        $this->assertEmpty($comment->getCreatedAt());
        $this->assertEmpty($comment->getPaint());
        $this->assertEmpty($comment->getBlogPost());
    }
}
