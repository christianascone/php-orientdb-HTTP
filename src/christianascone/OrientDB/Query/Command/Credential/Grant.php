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
 * The Grant class it's used to build GRANT SQL statements.
 *
 * @package    christianascone\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Command\Credential;

use christianascone\OrientDB\Query\Command\Credential;

class Grant extends Credential
{
    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "GRANT :Permission ON :Resource TO :Role";
    }
}
