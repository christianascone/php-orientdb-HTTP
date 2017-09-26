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
use christianascone\OrientDB\Query\Command\OClass\Drop;

class DropTest extends TestCase
{
    public function setup()
    {
        $this->drop = new Drop('p');
    }

    public function testTheSchemaIsValid()
    {
        $tokens = array(
            ':Class' => array(),
        );

        $this->assertTokens($tokens, $this->drop->getTokens());
    }

    public function testConstructionOfAnObject()
    {
        $query = 'DROP CLASS p';

        $this->assertCommandGives($query, $this->drop->getRaw());
    }
}
