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
 * @author      David Funaro <ing.davidino@gmail.com>
 */

namespace christianascone\OrientDB\Query\Formatter\Query;

use christianascone\OrientDB\Query\Formatter\Query;

class RebuildIndex extends Query implements TokenInterface
{
    public static function format(array $values)
    {

        if (count($values) == 1) {
            $index = $values[0];

            if ($index == '*'){
                return $index;
            }

            if (preg_match('/\w+.\w+/',$index)){
                return self::implodeRegular($values, '\.');
            }
        }

        return null;

    }
}