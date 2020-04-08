<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 20:07
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Psr\Container\ContainerInterface;
use ReflectionException;

/**
 * Class EventDispatcherFactory
 * @package Zellien\EventDispatcher
 */
final class EventDispatcherFactory {

    /**
     * @param ContainerInterface $container
     * @return EventDispatcherInterface
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): EventDispatcherInterface {
        $config = $container->get('config');
        $relations = $config['event_dispatcher']['relations'] ?? [];
        $factories = $config['event_dispatcher']['factories'] ?? [];
        $resolver = new ListenerResolver();
        foreach ($relations as $event => $rel) {
            $priority = 100;

            // Retrieve listener
            if (is_array($rel) && isset($rel['listener'])) {
                $listener = $rel['listener'];
                if (isset($rel['priority']) && is_numeric($rel['priority'])) {
                    $priority = intval($rel['priority']);
                }
            } elseif (is_string($rel)) {
                $listener = $rel;
            } else {
                continue;
            }

            // Check listener interface and factory exists
            if (!is_a($listener, ListenerInterface::class, true) || !isset($factories[$listener])) {
                continue;
            }

            $factory = $factories[$listener];

            // If invokable factory
            if (is_a($factory, ListenerFactoryInterface::class, true)) {
                $factory = new $factory();
            }

            // Attach listener to resolver
            if (is_callable($factory)) {
                $listener = call_user_func($factory, $container, $listener);
                $resolver->attach($event, $listener, $priority);
            }
        }

        return new EventDispatcher($resolver);
    }

}
