<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 09.03.2020 20:48
 */

declare(strict_types=1);

namespace Zellien\EventDispatcher;

use Zellien\Message\AbstractMessage;

/**
 * Class AbstractEvent
 * @package Zellien\EventDispatcher
 */
abstract class AbstractEvent extends AbstractMessage implements EventInterface {

}
