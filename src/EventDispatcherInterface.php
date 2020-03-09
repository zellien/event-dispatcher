<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 19:58
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;

/**
 * Interface EventDispatcherInterface
 * @package Zellien\EventDispatcher
 */
interface EventDispatcherInterface extends PsrEventDispatcherInterface {

    /**
     * Dispatch all events from haystack
     * @param iterable $events
     */
    public function dispatchAll(iterable $events): void;

}
