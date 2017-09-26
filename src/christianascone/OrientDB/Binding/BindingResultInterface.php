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
 * This interface is used by the BindingInterface to return results from
 * the server.
 *
 * @package    christianascone\OrientDB
 * @subpackage Binding
 * @author     Daniele Alessandri <suppakilla@gmail.com>
 */

namespace christianascone\OrientDB\Binding;

interface BindingResultInterface
{
    /**
     * Returns the whole payload from the server response.
     *
     * @return mixed
     */
    public function getData();

    /**
     * Returns the result set from the server response.
     *
     * @return mixed
     */
    public function getResult();
}
