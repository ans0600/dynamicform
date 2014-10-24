<?php


namespace Acme\DataGridBundle\Tests\Functional;


use Acme\DataGridBundle\Entity\TestUserAddress;
use Acme\DataGridBundle\Tests\KernelAwareTest;
use Symfony\Component\Security\Tests\Core\Authentication\Token\TestUser;

class EntityServiceTest extends KernelAwareTest
{


  /**
   * @var Acme\DynamicFormBundle\Services\DataGrid\EntityService
   */
  private $entityService;



  public function setUp()
  {
    parent::setUp();

    $this->insertTestData();

    $this->entityService = $this->get('services.datagrid.entity_service');
    $this->entityService->init("AcmeDataGridBundle:TestUserAddress");
  }

  public function testGetFields()
  {
    $fields = $this->entityService->getFieldMetadata();

    $this->assertTrue(count($fields) === 7);

    $this->assertTrue($fields[0]['fieldName']==='id');

    $this->assertTrue($fields[0]['type']==='integer');

    $this->assertTrue($fields[1]['fieldName']==='shortName');

    $this->assertTrue($fields[1]['type']==='string');

    $this->assertTrue($fields[2]['fieldName']==='address_1');

    $this->assertTrue($fields[2]['type']==='string');

    $this->assertTrue($fields[3]['fieldName']==='address_2');

    $this->assertTrue($fields[3]['type']==='string');

    $this->assertTrue($fields[4]['fieldName']==='suburb');

    $this->assertTrue($fields[4]['type']==='string');

    $this->assertTrue($fields[5]['fieldName']==='state');

    $this->assertTrue($fields[5]['type']==='string');

    $this->assertTrue($fields[6]['fieldName']==='postcode');

    $this->assertTrue($fields[6]['type']==='string');

  }

  public function testLoadDataWithLimit()
  {
    $this->entityService->loadData(1,15,null,null);

    $this->entityService->getFieldMetadata();

    $arr=$this->entityService->toSimpleArray();

    $this->assertTrue(count($arr)==15);

  }

  public function testLoadDataWithOrderAsc()
  {
    $this->entityService->loadData(1,20,'id','asc');

    $this->entityService->getFieldMetadata();

    $arr=$this->entityService->toSimpleArray();

    $this->assertTrue(count($arr)==20);


    $this->assertTrue($arr[0]['id']==1);

  }

  public function testLoadDataWithOrderDesc()
  {
    $this->entityService->loadData(1,20,'id','desc');

    $this->entityService->getFieldMetadata();

    $arr=$this->entityService->toSimpleArray();

    $this->assertTrue(count($arr)==20);


    $this->assertTrue($arr[0]['id']==500);

  }

  public function testTotalCount()
  {

    $count=$this->entityService->getTotalDataCount();

    $this->assertTrue($count==500);

  }


  private function insertTestData()
  {
    $batchSize=50;

    for($i=0;$i<500;$i++)
    {
      $record=new TestUserAddress();
      $record->setAddress1("address1_data_#{$i}");
      $record->setAddress2("address2_data_#{$i}");
      $record->setPostcode("postcode_data_#{$i}");
      $record->setShortName("address_#{$i}");
      $record->setState("state_#{$i}");
      $record->setSuburb("suburb_#{$i}");
      $this->entityManager->persist($record);
      if(($i%$batchSize)===0)
      {
        $this->entityManager->flush();
        $this->entityManager->clear();
      }

    }
    $this->entityManager->flush();
    $this->entityManager->clear();

  }



}
 