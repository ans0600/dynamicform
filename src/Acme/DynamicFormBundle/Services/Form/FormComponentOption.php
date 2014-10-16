<?php

namespace Acme\DynamicFormBundle\Services\Form;

use Symfony\Component\Form\FormBuilderInterface;

class FormComponentOption extends BaseFormComponent {

    const FIELD_TYPE="category";

    public function add(FormBuilderInterface $fb)
    {
        //return $fb->add(self::FIELD_TYPE)
    }
}