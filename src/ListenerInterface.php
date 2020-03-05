<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 18:38
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

/**
 * Interface ListenerInterface
 * @package Zellien\EventDispatcher
 */
interface ListenerInterface {

    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function handle(EventInterface $event);

}
