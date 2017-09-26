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
 * Class Limit
 *
 * @package     christianascone\OrientDB
 * @subpackage  Formatter
 * @author      Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Formatter\Query;

use christianascone\OrientDB\Query\Formatter\Query;

class Limit extends Query implements TokenInterface
{
    public static function format(array $values)
    {
        foreach ($values as $limit) {
            if (is_numeric($limit) && $limit > 0) {
                return "LIMIT $limit";
            }
        }

        return null;
    }
}
