<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 16/10/14
 * Time: 9:56 PM
 */

namespace Acme\DynamicFormBundle\Services\Form;

use Symfony\Component\Form\FormBuilderInterface;

class FormComponentText extends BaseFormComponent {

    const FIELD_TYPE="text";

    private $fieldName;

    public function __construct($fieldName)
    {
        $this->fieldName=$fieldName;
    }

    public function add(FormBuilderInterface $fb)
    {
        return $fb->add($this->fieldName,self::FIELD_TYPE);
    }
}