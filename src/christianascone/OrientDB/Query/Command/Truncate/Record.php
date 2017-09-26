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
 * Class Record
 *
 * @package    christianascone\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\OrientDB\Query\Command\Truncate;

use christianascone\OrientDB\Query\Command;

class Record extends Command
{
    public function __construct($rid)
    {
        parent::__construct();

        $this->setToken('Rid', $rid);
    }

    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "TRUNCATE RECORD :Rid";
    }

    /**
     * @inheritdoc
     */
    protected function getTokenFormatters()
    {
        return array_merge(parent::getTokenFormatters(), array(
          'Rid'     => "christianascone\OrientDB\Query\Formatter\Query\Rid",
        ));
    }
}
