<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Paint;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => [
                ['setBlogPostDateAndUser', 10],
                ['setPaintDateAndUser', 10],
            ],
        ];
    }

    // BLOGPOST
    public function setBlogPostDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof BlogPost)) {
            return;
        }

        if ($entity->getCreatedAt() === null) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
        }

        if ($entity->getUser() === null) {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }

    // PAINT
    public function setPaintDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Paint)) {
            return;
        }

        if ($entity->getCreatedAt() === null) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
        }

        if ($entity->getUser() === null) {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }
}
