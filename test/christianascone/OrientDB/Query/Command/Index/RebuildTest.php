<?php

/**
 * RemoveTest
 *
 * @package    christianascone\OrientDB
 * @subpackage Test
 * @author     David Funaro <ing.davidino@gmail.com>
 * @version
 */

namespace test\christianascone\OrientDB\Query\Command\Index;

use test\PHPUnit\TestCase;
use christianascone\OrientDB\Query\Command\Index\Rebuild;

class RebuildTest extends TestCase
{
    public function setup()
    {
        $this->rebuild = new Rebuild('indexName');
    }

    public function testTheSchemaIsValid()
    {
        $tokens = array(
            ':IndexName' => array(),
        );

        $this->assertTokens($tokens, $this->rebuild->getTokens());
    }

    public function testConstructionOfAnObject()
    {
        $query = 'REBUILD INDEX indexName';

        $this->assertCommandGives($query, $this->rebuild->getRaw());
    }
}
