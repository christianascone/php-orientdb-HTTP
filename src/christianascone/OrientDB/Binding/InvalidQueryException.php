<?php

/*
 * This file is part of the Orient package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Invalid
 *
 * @package     christianascone\OrientDB
 * @subpackage  Binding
 * @author      Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @author      Daniele Alessandri <suppakilla@gmail.com>
 */

namespace christianascone\OrientDB\Binding;

use christianascone\OrientDB\Exception;

class InvalidQueryException extends Exception
{
    protected $result;

    public function __construct($message, BindingResultInterface $result)
    {
        $this->result = $result;

        parent::__construct($message);
    }

    public function getBindingResult()
    {
        return $this->result;
    }
}
