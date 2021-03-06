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
 * Command used to alter a class's native properties (eg. name, superclass).
 *
 * @package    christianascone\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Command\OClass;

use christianascone\OrientDB\Query\Command\OClass;

class Alter extends OClass
{
    /**
     * Sets the $class to alter, setting the $attribute to its new $value.
     *
     * @param string $class
     * @param string $attribute
     * @param string $value
     */
    public function __construct($class, $attribute, $value)
    {
        parent::__construct($class);

        $this->setToken('Attribute', $attribute);
        $this->setToken('Value', $value);
    }

    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "ALTER CLASS :Class :Attribute :Value";
    }

    /**
     * Returns the formatters for this query tokens
     *
     * @return array
     */
    protected function getTokenFormatters()
    {
        return array(
            'Class'         => "christianascone\OrientDB\Query\Formatter\Query\Regular",
            'Attribute'     => "christianascone\OrientDB\Query\Formatter\Query\Regular",
            'Value'         => "christianascone\OrientDB\Query\Formatter\Query\Regular",
        );
    }
}

