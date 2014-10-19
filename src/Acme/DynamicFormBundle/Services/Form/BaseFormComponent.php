<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 16/10/14
 * Time: 9:56 PM
 */

namespace Acme\DynamicFormBundle\Services\Form;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

abstract class BaseFormComponent {


    protected $fieldName;

    protected $fieldLabel;

    protected $constraints;

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return mixed
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @return mixed
     */
    public function getFieldLabel()
    {
        return $this->fieldLabel;
    }




    abstract public function add(FormBuilderInterface $fb);

} 