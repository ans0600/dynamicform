<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 10/23/14
 * Time: 9:06 AM
 */

namespace Acme\DataGridBundle\Services\DataGrid;


class DataGridService
{


  private $fields;

  private $data;

  private $entityService;

  private $currentLimit;

  private $currentPage;

  private $currentOrder;

  private $currentDir;

  private $entityName;

  public function __construct($entityService)
  {
    $this->entityService = $entityService;

  }

  public function getData()
  {
    return $this->data;
  }

  public function getFields()
  {
    return $this->fields;
  }

  public function getTotalRows()
  {
    return $this->entityService->getTotalDataCount();

  }

  public function getTotalPages()
  {
    return ceil($this->getTotalRows() / $this->currentLimit);
  }


  public function getCurrentpage()
  {
    return $this->currentPage;
  }

  public function getCurrentLimit()
  {
    return $this->currentLimit;
  }

  public function getCurrentOrder()
  {
    return $this->currentOrder;
  }

  public function getCurrentDir()
  {
    return $this->currentDir;
  }

  public function getEntityName()
  {
    return $this->entityName;
  }

  public function getLimits()
  {
    $arr = array(10, 20, 50, 100);

    $res = array();

    foreach ($arr as $r) {
      $res[$r] = $this->currentLimit == $r;
    }
    return $res;

  }

  public function getDataGrid($entityName, $currentPage = 1, $currentLimit = 10, $orderBy, $dir)
  {
    if ($currentLimit < 0) $currentLimit = 10;
    if ($currentPage < 0) $currentPage = 1;
    $this->currentLimit = $currentLimit;
    $this->currentPage = $currentPage;
    $this->currentOrder = $orderBy;
    $this->currentDir = $dir;
    $this->entityName = $entityName;
    $this->entityService->init($entityName);
    $this->fields = $this->entityService->getFieldMetadata();
    $this->entityService->loadData($currentPage, $currentLimit, $orderBy, $dir);
    $this->data = $this->entityService->toSimpleArray();

    return $this;
  }


}