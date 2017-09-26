<?php

/**
 * CountTest
 *
 * @package    christianascone\OrientDB
 * @subpackage Test
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @version
 */

namespace test\christianascone\OrientDB\Query\Command\Index;

use test\PHPUnit\TestCase;
use christianascone\OrientDB\Query\Command\Index\Count;

class CountTest extends TestCase
{
    public function setup()
    {
        $this->count = new Count('indexName');
    }

    public function testTheSchemaIsValid()
    {
        $tokens = array(
            ':Name' => array(),
        );

        $this->assertTokens($tokens, $this->count->getTokens());
    }

    public function testConstructionOfAnObject()
    {
        $query = 'SELECT count(*) AS size from index:indexName';

        $this->assertCommandGives($query, $this->count->getRaw());
    }
}
