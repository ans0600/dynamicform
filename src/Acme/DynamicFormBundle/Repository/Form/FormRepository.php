<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 19/10/14
 * Time: 4:32 PM
 */

namespace Acme\DynamicFormBundle\Repository\Form;

class FormRepository {

    private $em;

    public function __construct($em)
    {
        $this->em=$em;
    }


    public function getFormById($id)
    {
        return $this->em->getRepository('AcmeDynamicFormBundle:Form')
            ->find($id);

    }


} 