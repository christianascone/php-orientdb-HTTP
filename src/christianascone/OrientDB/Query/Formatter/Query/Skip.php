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
 * Class Skip
 *
 * @package     christianascone\OrientDB
 * @subpackage  Formatter
 * @author      Daniele Alessandri <suppakilla@gmail.com>
 */

namespace christianascone\OrientDB\Query\Formatter\Query;

use christianascone\OrientDB\Query\Formatter\Query;

class Skip extends Query implements TokenInterface
{
    public static function format(array $values)
    {
        if ($values && is_numeric($records = $values[0]) && $records >= 0) {
            return "SKIP $records";
        }
    }
}
