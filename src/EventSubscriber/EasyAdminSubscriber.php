<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Paint;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;
    private $filesystem;

    public function __construct(SluggerInterface $slugger, Security $security, Filesystem $filesystem)
    {
        $this->slugger = $slugger;
        $this->security = $security;
        $this->filesystem = $filesystem;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => [
                ['setBlogPostSlugAndDateAndUser', 10],
                ['setPaintSlugAndDateAndUser', 10],
            ],
            BeforeEntityDeletedEvent::class => [
                ['removeBlogPostImage', 10],
                ['removePaintImage', 10],
            ],
        ];
    }

    // BLOGPOST
    public function setBlogPostSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof BlogPost)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle())->lower();
        $entity->setSlug($slug);

        if ($entity->getCreatedAt() === null) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
        }

        if ($entity->getUser() === null) {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }

    public function removeBlogPostImage(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof BlogPost)) {
            return;
        }

        $imageFilename = $entity->getFile();
        if ($imageFilename) {
            $imagePath = __DIR__ . '/../../public/uploads/images/blogposts/' . $imageFilename;

            if (file_exists($imagePath)) {
                $this->filesystem->remove($imagePath);
            }
        }
    }

    // PAINT
    public function setPaintSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Paint)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getName())->lower();
        $entity->setSlug($slug);

        if ($entity->getCreatedAt() === null) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
        }

        if ($entity->getUser() === null) {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }

    public function removePaintImage(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Paint)) {
            return;
        }

        $imageFilename = $entity->getFile();
        if ($imageFilename) {
            $imagePath = __DIR__ . '/../../public/uploads/images/paints/' . $imageFilename;

            if (file_exists($imagePath)) {
                $this->filesystem->remove($imagePath);
            }
        }
    }
}
