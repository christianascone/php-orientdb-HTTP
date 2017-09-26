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
 * Class Where
 *
 * @package     christianascone\OrientDB
 * @subpackage  Formatter
 * @author      Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Formatter\Query;

use christianascone\OrientDB\Query\Formatter\Query;

class IndexClass extends Query implements TokenInterface
{
    public static function format(array $values)
    {
        if ($values) {
            return self::stripNonSQLCharacters(array_shift($values)) . '.';
        }

        return null;
    }
}
