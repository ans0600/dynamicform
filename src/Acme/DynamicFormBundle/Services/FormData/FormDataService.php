<?php

namespace Acme\DynamicFormBundle\Services\FormData;

use Acme\DynamicFormBundle\Entity\Form;
use Acme\DynamicFormBundle\Entity\FormData;

class FormDataService {


    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine=$doctrine;

    }


    public function createFormDataTable(Form $form,$schema)
    {
        $formDataTable=new FormData();
        $formDataTable->setForm($form);
        $formDataTable->setSchematic($schema);

        $em = $this->doctrine->getManager();
        $em->persist($formDataTable);
        $em->flush();

        $this->updateMetricDatabase($formDataTable);

        return $formDataTable;
    }


    public function updateMetricDatabase(FormData $formDataTable)
    {
        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->doctrine->getManager());
        $tool->updateSchema(array($formDataTable->buildItemClassMetadata()), true);
    }

    public function getFormDataById($formId)
    {
        $em=$this->doctrine->getManager('form');
        $query=$em->createQuery('SELECT d from \\Acme\\DynamicFormBundle\\DynamicEntity\\form_'.$formId.' d');

        $data=$query->getResult();

        return $data;

    }

} 