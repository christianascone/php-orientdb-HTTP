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
 * Class used to identify a document's annotations.
 *
 * @package    christianascone\ODM
 * @subpackage OrientDB
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace christianascone\ODM\OrientDB\Mapper\Annotations;

/**
 * @Annotation
 */
class Document extends \Doctrine\Common\Annotations\Annotation
{
    public $class;

    /**
     * Given a $christianascone\OrientDBClass, checks wheter this annotation matches it.
     *
     * @param  string   $christianascone\OrientDBClass
     * @return boolean
     */
    public function hasMatchingClass($orientClass)
    {
        $classes = explode(',', $this->class);

        foreach ($classes as $class) {
            if ($class === $orientClass) {
                return true;
            }
        }

        return false;
    }
}
