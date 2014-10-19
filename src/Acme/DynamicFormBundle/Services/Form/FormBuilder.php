<?php

namespace Acme\DynamicFormBundle\Services\Form;

use Acme\DynamicFormBundle\Services\DataField\GenericDataField;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class FormBuilder {


    private $formFactory;


    public function __construct($formFactory)
    {
        $this->formFactory=$formFactory;
    }

    public function generateForm($formComponents)
    {
        $data=array();

        $form=$this->formFactory->createBuilder('form',$data,array());
        if(is_array($formComponents)&&count($formComponents)>0)
        {
            foreach($formComponents as $formComponent) {
                //this->container->get('form.factory')->createBuilder('form', $data, $options);
                $form = $formComponent->add($form);
            }
        }
        return $form;
    }

} 