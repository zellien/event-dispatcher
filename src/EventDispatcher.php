<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 19:59
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Zellien\EventDispatcher\Exception\InvalidArgumentException;

/**
 * Class EventDispatcher
 * @package Zellien\EventDispatcher
 */
final class EventDispatcher implements EventDispatcherInterface {

    /**
     * @var ListenerResolverInterface
     */
    private $resolver;

    /**
     * EventDispatcher constructor.
     * @param ListenerResolverInterface $resolver
     */
    public function __construct(ListenerResolverInterface $resolver) {
        $this->resolver = $resolver;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(object $event): void {
        if (!$event instanceof EventInterface) {
            throw new InvalidArgumentException(sprintf('Event %s is invalid, %s expected, %s given.!',
                get_class($event),
                EventInterface::class,
                gettype($event)));
        }
        $listeners = $this->resolver->getListenersForEvent($event);
        /** @var ListenerInterface $listener */
        foreach ($listeners as $listener) {
            $listener->handle($event);
        }
    }

}
