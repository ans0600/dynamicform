<?php

namespace Acme\DynamicFormBundle\Services\Form;

use Acme\DynamicFormBundle\Entity\Field;
use Acme\DynamicFormBundle\Services\Util\Utils;
use Symfony\Component\Form\FormBuilderInterface;

class FormComponentOption extends BaseFormComponent
{

    const FIELD_TYPE = "category";


    private $optionData;

    public function __construct(Field $f)
    {
        $this->fieldName=$f->getFieldName();
        $this->fieldLabel=$f->getFieldLabel();
        $this->optionData = json_decode($f->getFieldInitialData());
        $this->optionData=Utils::object_to_array($this->optionData);
    }


    public function add(FormBuilderInterface $fb)
    {
        return $fb->add('options', 'choice',
                $this->optionData,
            array(
                'label'=>$this->getFieldLabel()
            )
        );

    }
}