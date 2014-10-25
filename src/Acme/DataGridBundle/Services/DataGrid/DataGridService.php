<?php

namespace Acme\DataGridBundle\Services\DataGrid;


use Acme\DataGridBundle\Services\Request\BaseDataGridRequest;

class DataGridService
{

    private $fields;

    private $data;

    private $entityService;

    /**
     * @var Acme\DynamicFormBundle\Services\Request\DataGridRequest
     */
    private $requestObj;

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
        return ceil($this->getTotalRows() / $this->requestObj->getData('limit'));
    }


    public function getCurrentpage()
    {
        return $this->requestObj->getData('page');
    }

    public function getCurrentLimit()
    {
        return $this->requestObj->getData('limit');
    }

    public function getCurrentOrder()
    {
        return $this->requestObj->getData('order');
    }

    public function getCurrentDir()
    {
        return $this->requestObj->getData('dir');
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function getLimits()
    {
        //TODO Put limit value in parameter list
        $arr = array(10, 20, 50, 100);

        $res = array();

        foreach ($arr as $r) {
            $res[$r] = $this->getCurrentLimit() == $r;
        }
        return $res;

    }

    public function getDataGrid($entityName,BaseDataGridRequest $request)
    {
        $this->requestObj=$request;
        $this->entityName = $entityName;
        $this->entityService->init($entityName);
        $this->fields = $this->entityService->getFieldMetadata();
        $this->entityService->loadData($request);
        $this->data = $this->entityService->toSimpleArray();
        return $this;
    }


}