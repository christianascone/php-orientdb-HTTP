<?php

/**
 * QueryTest
 *
 * @package    christianascone\OrientDB
 * @subpackage Test
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @version
 */

namespace test\christianascone\OrientDB\Query\Command\OClass;

use test\PHPUnit\TestCase;
use christianascone\OrientDB\Query\Command\OClass\Create;

class CreateTest extends TestCase
{
    public function setup()
    {
        $this->create = new Create('p');
    }

    public function testTheSchemaIsValid()
    {
        $tokens = array(
            ':Class' => array(),
        );

        $this->assertTokens($tokens, $this->create->getTokens());
    }

    public function testConstructionOfAnObject()
    {
        $query = 'CREATE CLASS p';

        $this->assertCommandGives($query, $this->create->getRaw());
    }
}
