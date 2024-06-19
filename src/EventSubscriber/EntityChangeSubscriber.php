<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Entity;
use App\Entity\Port;
use App\Entity\Manufacturer;
use App\Entity\Model;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class EntityChangeSubscriber implements EventSubscriberInterface
{
    private $logger;

    private const ENTITY_NAMES = [
        Port::class => 'Port',
        Manufacturer::class => 'Manufacturer',
        Entity::class => 'Entity',
        Model::class => 'Model',
    ];

    public function __construct(LoggerInterface $entityChangesLogger)
    {
        $this->logger = $entityChangesLogger;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['logEntityChanges', EventPriorities::POST_WRITE],
        ];
    }

    public function logEntityChanges(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!in_array($method, [Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH])) {
            return;
        }

        $entityClass = get_class($entity);
        $entityName = self::ENTITY_NAMES[$entityClass] ?? null;

        if (!$entityName) {
            return; // If the entity is not one of the specified types, do nothing
        }

        $action = $method === Request::METHOD_POST ? 'created' : 'updated';

        // Log the entity changes using Monolog
        $this->logger->info(sprintf('%s %s:', $entityName, $action), [
            'method' => $method,
            'entity' => [
                'id' => $entity->getId(),
                'details' => $entity,
            ],
        ]);
    }
}