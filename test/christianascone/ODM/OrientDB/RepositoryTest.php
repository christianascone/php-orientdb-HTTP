<?php

/**
 * ReporitoryTest
 *
 * @package    christianascone\ODM\OrientDB
 * @subpackage Test
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @author     David Funaro <ing.davidino@gmail.com>
 * @version
 */

namespace test\christianascone\ODM\OrientDB;

use test\PHPUnit\TestCase;
use christianascone\ODM\OrientDB\Manager;
use christianascone\ODM\OrientDB\Mapper;
use christianascone\ODM\OrientDB\Repository;
use christianascone\ODM\OrientDB\Types\Rid;

class RepositoryTest extends TestCase
{
    protected function createRepository()
    {
        $rawResult = json_decode('[{
            "@type": "d", "@rid": "#19:1", "@version": 1, "@class": "Address",
            "name": "Luca",
            "surname": "Garulli",
            "out": ["#20:1"]
        }, {
            "@type": "d", "@rid": "#19:1", "@version": 1, "@class": "Address",
            "name": "Luca",
            "surname": "Garulli",
            "out": ["#20:1"]
        }]');

        $result = $this->getMock('christianascone\OrientDB\Binding\BindingResultInterface');
        $result->expects($this->at(0))
               ->method('getResult')
               ->will($this->returnValue($rawResult));
        $result->expects($this->at(1))
               ->method('getResult')
               ->will($this->returnValue(array()));

        $binding = $this->getMock('christianascone\OrientDB\Binding\BindingInterface');
        $binding->expects($this->any())
                ->method('execute')
                ->will($this->returnValue($result));

        $manager = $this->prepareManager($binding);

        $repository = new Repository('test\christianascone\ODM\OrientDB\Document\Stub\Contact\Address', $manager);

        return $repository;
    }

    protected function prepareManager($binding)
    {
        $configuration = $this->getConfiguration(array('document_dirs' => array('test/christianascone/ODM/OrientDB/Document/Stub' => 'test')));
        return new Manager($binding, $configuration);
    }

    public function testFindAll()
    {
        $repository = $this->createRepository();
        $documents = $repository->findAll();

        $this->assertSame(2, count($documents));
    }
    
    public function testYouCanExecuteFindByQueries()
    {
        $repository = $this->createRepository();
        $documents  = $repository->findByUsername('hello');
        
        $this->assertSame(2, count($documents));
    }
    
    public function testYouCanExecuteFindOneByQueries()
    {
        $repository = $this->createRepository();
        $documents  = $repository->findOneByUsername('hello');
        
        $this->assertSame(1, count($documents));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testYouCantCallWhateverMethodOfARepository()
    {
        $repository = new Repository('My\\Class', $this->prepareManager(new \christianascone\OrientDB\Binding\HttpBinding(new \christianascone\OrientDB\Binding\BindingParameters())));
        $documents  = $repository->findOn();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testYouCanOnlyPassObjectsHavingGetRidMethodAsArgumentsOfFindSomeBySomething()
    {
        $repository = new Repository('My\\Class', $this->prepareManager(new \christianascone\OrientDB\Binding\HttpBinding(new \christianascone\OrientDB\Binding\BindingParameters())));
        $documents  = $repository->findOneByJeex(new \stdClass());
    }
}
