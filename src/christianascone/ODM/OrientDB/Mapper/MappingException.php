<?php

namespace christianascone\ODM\OrientDB\Mapper;


use christianascone\ODM\OrientDB\Types\Rid;

/**
 * Class MappingException
 *
 * @package    christianascone\ODM
 * @subpackage OrientDB
 * @author     Tamás Millián <tamas.millian@gmail.com>
 */
class MappingException extends \Exception
{
    public static function missingRid($class)
    {
        return new self(sprintf('The identifier mapping for %s could not be found.', $class));
    }

    public static function noClusterForRid(Rid $rid)
    {
        return new self(sprintf('There is no cluster for %s.', $rid->getValue()));
    }
} 