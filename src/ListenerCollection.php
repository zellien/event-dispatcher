<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 19:32
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

/**
 * Class ListenerCollection
 * @package Zellien\EventDispatcher
 */
final class ListenerCollection implements ListenerCollectionInterface {

    /**
     * @var ListenerInterface[]
     */
    private $listeners = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @inheritDoc
     */
    public function attach(ListenerInterface $listener, int $priority = 100): ListenerCollectionInterface {
        $this->listeners[] = ['listener' => $listener, 'priority' => $priority];
        usort($this->listeners, function ($a, $b) {
            return strnatcmp($a['priority'], $b['priority']);
        });
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detach(ListenerInterface $listener): ListenerCollectionInterface {
        foreach ($this->listeners as $key => $item) {
            if ($item['listener'] == $listener) {
                unset($this->listeners[$key]);
            }
        }
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function current() {
        return $this->listeners[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next() {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function key() {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid() {
        return isset($this->listeners[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind() {
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function count() {
        return count($this->listeners);
    }

}
