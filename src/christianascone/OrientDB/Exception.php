<?php

/*
 * This file is part of the christianascone\OrientDB package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This is a general Exception class for the christianascone\OrientDB library.
 *
 * @package    christianascone\OrientDB
 * @subpackage
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB;

class Exception extends \Exception
{
    public function __construct($message)
    {
        $this->message = $message;
    }
}
