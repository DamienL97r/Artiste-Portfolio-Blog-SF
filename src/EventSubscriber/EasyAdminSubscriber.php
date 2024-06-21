<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
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
            BeforeEntityPersistedEvent::class => ['setBlogPostSlugAndDateAndUser'],
            BeforeEntityDeletedEvent::class => ['removeBlogPostImage']
        ];
    }

    public function setBlogPostSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof BlogPost)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle());
        $entity->setSlug($slug);

        $now = new DateTime('now');
        $entity->setCreatedAt($now);

        $user = $this->security->getUser();
        $entity->setUser($user);
    }

    public function removeBlogPostImage(BeforeEntityDeletedEvent $event)
{
    $entity = $event->getEntityInstance();

    if (!($entity instanceof BlogPost)) {
        return;
    }

    $imageFilename = $entity->getFile();
    if ($imageFilename) {
        $imagePath = __DIR__ . '/../../public/uploads/images/' . $imageFilename;

        if (file_exists($imagePath)) {
            $this->filesystem->remove($imagePath);
        }
    }
}
}
