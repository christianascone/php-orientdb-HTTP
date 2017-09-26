<?php

/**
 * SQL command Update interface
 *
 * @package    christianascone\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Command;

interface UpdateInterface
{
    /**
     * Set the $values of the updates to be done.
     * You can $append the values.
     *
     * @param  array   $values
     * @param  boolean $append
     * @return Update
     */
    public function set(array $values, $append);
}
