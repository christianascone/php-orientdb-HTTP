<?php

namespace test\christianascone\ODM\OrientDB\Document\Stub;

use christianascone\ODM\OrientDB\Mapper\Annotations as ODM;

/**
* @ODM\Document(class="OCity")
*/
class City
{
    /**
     * @ODM\Property(name="@rid", type="string")
     */
    public $rid;

    private $name;
}
