<?php


namespace Acme\DataGridBundle\Services\DataGrid;


use Acme\DataGridBundle\Services\Utils\EntityFieldUtil;

class EntityService {

  private $className;

  private $doctrine;

  private $classMetadata;

  private $fieldMetadata;

  private $entityData;


  public function __construct($doctrine)
  {
    $this->doctrine=$doctrine;

  }

  public function init($className)
  {
    $this->className=$className;
    $em=$this->doctrine->getManager();
    $this->classMetadata=$em->getClassMetadata($this->className);

  }

  public function getFieldMetadata()
  {
    $this->fieldMetadata=array();

    foreach($this->classMetadata->getFieldNames() as $name)
    {
      $mapping = $this->classMetadata->getFieldMapping($name);

      $this->fieldMetadata[]=array('fieldName'=>$mapping['fieldName'],'type'=>$mapping['type']);
    }
    return $this->fieldMetadata;

  }

  public function getTotalDataCount()
  {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    $em=$this->doctrine->getManager();

    $qb=$em->createQueryBuilder();
    $qb->select('count(d)')->from($this->className,'d');

    $count=$qb->getQuery()->getSingleScalarResult();

    return $count;

  }

  public function loadData($page=1,$limit=100,$orderBy,$dir)
  {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    $em=$this->doctrine->getManager();

    $orderCriteria=array();
      if($orderBy&&$dir)
      {
          $orderCriteria=array($orderBy=>$dir);
      }

    $this->entityData=$em->getRepository($this->className)
        ->findBy(array(),$orderCriteria,$limit,($page-1)*$limit);


    return $this->entityData;
  }


  public function toSimpleArray()
  {
    if($this->entityData&&$this->fieldMetadata&&count($this->entityData)>0)
    {
      $res=array();

      foreach($this->entityData as $row)
      {
        $r=array();
        foreach($this->fieldMetadata as $field)
        {
          $func=EntityFieldUtil::getEntityGetterName($field['fieldName']);
         $r[$field['fieldName']]=$row->$func();

        }
        $res[]=$r;

      }

      return $res;
    }

  }


} 