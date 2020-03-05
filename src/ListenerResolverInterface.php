<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 18:41
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Interface ListenerResolverInterface
 * @package Zellien\EventDispatcher
 */
interface ListenerResolverInterface extends ListenerProviderInterface {

    /**
     * @param string            $eventName
     * @param ListenerInterface $listener
     * @param int               $priority
     * @return ListenerResolverInterface
     */
    public function attach(string $eventName, ListenerInterface $listener, int $priority = 100): ListenerResolverInterface;

    /**
     * @param string            $eventName
     * @param ListenerInterface $listener
     * @return ListenerResolverInterface
     */
    public function detach(string $eventName, ListenerInterface $listener): ListenerResolverInterface;

}
