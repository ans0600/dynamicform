<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 16/10/14
 * Time: 9:56 PM
 */

namespace Acme\DynamicFormBundle\Services\Form;

use Acme\DynamicFormBundle\Entity\Field;
use Symfony\Component\Form\FormBuilderInterface;

class FormComponentText extends BaseFormComponent {

    const FIELD_TYPE="text";


    public function __construct(Field $f)
    {
        $this->fieldName=$f->getFieldName();
        $this->fieldLabel=$f->getFieldLabel();
        $this->constraints=$f->getConstraints();
    }

    public function add(FormBuilderInterface $fb)
    {
        $constraintsObj=array();

        if(count($this->constraints)>0)
        {
            foreach($this->constraints as $c)
            {
                $constraintsObj[]=$c->getConstraintObject();
            }
        }

        return $fb->add($this->fieldName,
            self::FIELD_TYPE,
            array(
                'label'=>$this->getFieldLabel(),
                'constraints'=>$constraintsObj,
                //'required'=>false
            )
        );
    }
}