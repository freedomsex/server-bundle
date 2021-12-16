<?php


namespace FreedomSex\ServerBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityDateUpdate implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->index($args, true);
    }

    public function index(LifecycleEventArgs $args, $isNew = false)
    {
        $entity = $args->getObject();
        if (!$entity) {
            return;
        }

        $date = new \DateTime();

        $meta = $args->getObjectManager()->getClassMetadata(get_class($entity))->getFieldNames();

        if ($isNew) {
            if (in_array('added', $meta) and !$entity->getAdded()) {
                $entity->setAdded($date);
            }
            if (in_array('created', $meta) and !$entity->getCreated()) {
                $entity->setCreated($date);
            }
        }

        if (in_array('updated', $meta)) {
            $entity->setUpdated($date);
        }
    }

}
