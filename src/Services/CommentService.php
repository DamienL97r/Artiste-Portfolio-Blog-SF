<?php

namespace App\Services;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Paint;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

readonly class CommentService
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function persistComment(
        Comment $comment,
        BlogPost $blogPost = null,
        Paint $paint = null
        ) : void {
            $comment->setIsPublished(false)
                    ->setBlogPost($blogPost)
                    ->setPaint($paint)
                    ->setCreatedAt(new DateTime('now'));
            
            $this->manager->persist($comment);
            $this->manager->flush();
    }
}
