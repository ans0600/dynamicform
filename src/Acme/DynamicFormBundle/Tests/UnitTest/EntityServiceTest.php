<?php


namespace Acme\DynamicFormBundle\Tests\UnitTest;


use Acme\DynamicFormBundle\Tests\KernelAwareTest;

class EntityServiceTest extends KernelAwareTest
{


  /**
   * @var Acme\DynamicFormBundle\Services\DataGrid\EntityService
   */
  private $entityService;

  public function setUp()
  {
    parent::setUp();
    $this->entityService = $this->get('services.datagrid.entity_service');
  }

//  public function testGetFields()
//  {
//    $this->entityService->init("AcmeDynamicFormBundle:Form");
//
//    $fields = $this->entityService->getFieldMetadata();
//
//    var_dump(count($fields));
//
//    $this->assertTrue(count($fields) == 2);
//
//    $this->assertTrue($fields[0]['fieldName']==='id');
//
//    $this->assertTrue($fields[0]['type']==='integer');
//
//    $this->assertTrue($fields[1]['fieldName']==='name');
//
//    $this->assertTrue($fields[1]['type']==='string');
//
//  }

//  public function testLoadData()
//  {
//    $this->entityService->init("AcmeDynamicFormBundle:Form");
//
//    $this->entityService->loadData();
//
//    $fields = $this->entityService->getFieldMetadata();
//
//    $arr=$this->entityService->toSimpleArray();
//    var_dump($arr);
//
//  }

  public function testTotalCount()
  {
    $this->entityService->init("AcmeDynamicFormBundle:Form");

    $count=$this->entityService->getTotalDataCount();

    $this->assertTrue($count==5);

  }



}
 