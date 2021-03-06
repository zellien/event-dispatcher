<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 20:06
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Interop\Container\ContainerInterface;

/**
 * Interface ListenerFactoryInterface
 * @package Zellien\EventDispatcher
 */
interface ListenerFactoryInterface {

    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     * @return ListenerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ListenerInterface;

}
