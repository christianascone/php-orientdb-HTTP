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
 * This class handles the generation of SQL statements to remove properties
 * from a class.
 *
 * @package    christianascone\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Command\Property;

use christianascone\OrientDB\Query\Command\Property;

class Drop extends Property
{
    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "DROP PROPERTY :Class.:Property";
    }
}
