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
use ReflectionClass;
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
        $factories = $config['event_dispatcher']['factories'] ?? [];
        $resolver = new ListenerResolver();
        foreach ($factories as $eventName => $factory) {
            if (is_array($factory) && isset($factory['listener'])) {
                $listener = $factory['listener'];
                $priority = $factory['priority'] ?: 100;
                if ($listener instanceof ListenerFactoryInterface) {
                    $reflection = new ReflectionClass($listener);
                    $listener = $reflection->newInstanceWithoutConstructor();
                }
                if (is_callable($listener)) {
                    $listener = call_user_func($listener, $container);
                    $resolver->attach($eventName, $listener, $priority);
                }
            }
        }
        return new EventDispatcher($resolver);
    }

}
