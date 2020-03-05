<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 18:49
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Countable;
use Iterator;

/**
 * Interface ListenerCollectionInterface
 * @package Zellien\EventDispatcher
 */
interface ListenerCollectionInterface extends Iterator, Countable {

    /**
     * Attaches an event listener to the collection
     * @param ListenerInterface $listener
     * @param int               $priority
     * @return ListenerCollectionInterface
     */
    public function attach(ListenerInterface $listener, int $priority = 100): ListenerCollectionInterface;

    /**
     * Detaches event listener from collection
     * @param ListenerInterface $listener
     * @return ListenerCollectionInterface
     */
    public function detach(ListenerInterface $listener): ListenerCollectionInterface;

}
