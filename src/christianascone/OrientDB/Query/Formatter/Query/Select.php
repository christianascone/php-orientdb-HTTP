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
 * @author      Daniele Alessandri <suppakilla@gmail.com>
 */

namespace christianascone\OrientDB\Query\Formatter\Query;

use christianascone\OrientDB\Query\Formatter\Query;

class Select extends Query implements TokenInterface
{
    public static function format(array $values)
    {
        return self::implodeRegular($values, '[:punct:]|\s');
    }
}
