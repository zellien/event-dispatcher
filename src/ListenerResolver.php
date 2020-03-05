<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 18:42
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Zellien\EventDispatcher\Exception\InvalidArgumentException;

/**
 * Class ListenerResolver
 * @package Zellien\EventDispatcher
 */
final class ListenerResolver implements ListenerResolverInterface {

    /**
     * @var ListenerCollection[]
     */
    private $map = [];

    /**
     * @param EventInterface $event
     * @return iterable
     */
    public function getListenersForEvent($event): iterable {
        $eventName = get_class($event);
        return $this->getListenerCollectionForEvent($eventName);
    }

    /**
     * @inheritDoc
     */
    public function attach(string $eventName, ListenerInterface $listener, int $priority = 100): ListenerResolverInterface {
        $this->ensureEventClassIsValid($eventName);
        $collection = $this->getListenerCollectionForEvent($eventName);
        $collection->attach($listener, $priority);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detach(string $eventName, ListenerInterface $listener): ListenerResolverInterface {
        $this->ensureEventClassIsValid($eventName);
        $collection = $this->getListenerCollectionForEvent($eventName);
        $collection->detach($listener);
        return $this;
    }

    /**
     * @param string $eventName
     * @return ListenerCollectionInterface
     */
    private function getListenerCollectionForEvent(string $eventName): ListenerCollectionInterface {
        if (!isset($this->map[$eventName])) {
            $this->map[$eventName] = new ListenerCollection();
        }
        return $this->map[$eventName];
    }

    /**
     * Ensures a valid event class
     * @param string $eventName
     * @return void
     */
    private function ensureEventClassIsValid(string $eventName): void {
        if (class_exists($eventName)) {
            $implements = class_implements($eventName);
            if (in_array(EventInterface::class, $implements)) {
                return;
            }
        }
        throw new InvalidArgumentException(sprintf('Event class %s is invalid. An event class must implement %s.', $eventName, EventInterface::class));
    }


}
