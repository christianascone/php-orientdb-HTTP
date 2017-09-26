<?php

/**
 * RidTest
 *
 * @package    christianascone\OrientDB
 * @subpackage Test
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @author     David Funaro <ing.davidino@gmail.com>
 * @version
 */

namespace test\christianascone\OrientDB\Query\Validator;

use test\PHPUnit\TestCase;
use christianascone\OrientDB\Query\Validator\Rid;


class RidTest extends TestCase
{
    public function setup()
    {
        $this->validator = new Rid();
    }

    public function testTheValidatorAcceptsAValidRid()
    {
        $this->assertEquals('#1:1', $this->validator->check('1:1'));
    }

    public function testTheValidatorAcceptsAValidPrefixedRid()
    {
        $this->assertEquals('#1:1', $this->validator->check('#1:1'));
    }

    /**
     * @expectedException christianascone\OrientDB\Query\Validator\ValidationException
     */
    public function testTheValidatorDoesNotAcceptsStringsOnly()
    {
        $this->validator->check('hola');
    }

    /**
     * @expectedException christianascone\OrientDB\Query\Validator\ValidationException
     */
    public function testTheValidatorDoesNotAcceptsIntegersOnly()
    {
        $this->validator->check('11');
    }

    /**
     * @expectedException christianascone\OrientDB\Query\Validator\ValidationException
     */
    public function testTheValidatorDoesNotAcceptsRidsWithMultiplesPrefixes()
    {
        $this->validator->check('##1:1');
    }

    /**
     * @expectedException christianascone\OrientDB\Query\Validator\ValidationException
     */
    public function testEmptyRid()
    {
        $this->validator->check('');
    }
}
