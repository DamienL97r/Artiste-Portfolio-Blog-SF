<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Paint;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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

        if (null === $entity->getCreatedAt()) {
            $now = new \DateTime('now');
            $entity->setCreatedAt($now);
        }

        if (null === $entity->getUser()) {
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

        if (null === $entity->getCreatedAt()) {
            $now = new \DateTime('now');
            $entity->setCreatedAt($now);
        }

        if (null === $entity->getUser()) {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }
}
