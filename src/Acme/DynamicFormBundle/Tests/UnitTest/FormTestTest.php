<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 19/10/14
 * Time: 6:50 PM
 */

use \Acme\DynamicFormBundle\Services\Form\FormComponentText;

class FormTestTest extends PHPUnit_Framework_TestCase {


    private $formComponentText;

    function setUp()
    {
        $mockField=$this->getMock("Acme\DynamicFormBundle\Entity\Field");
        $mockField->expects($this->any())->method("getFieldName")->will($this->returnValue("testFieldName"));
        $mockField->expects($this->any())->method("getFieldLabel")->will($this->returnValue("testFieldLabel"));
        $mockField->expects($this->any())->method("getConstraints")->will($this->returnValue(""));

        $this->formComponentText=new FormComponentText($mockField);

    }

    function tearDown()
    {


    }


    function testAddConstraint()
    {


//        $mockformBuilder=$this->getMock("Symfony\Component\Form\FormBuilderInterface");
//
//        $mockformBuilder->expects($this->once())->method('add')->will($this->returnValue($mockformBuilder));
//
//
//        $this->formComponentText->add($mockformBuilder);

    }

}
 