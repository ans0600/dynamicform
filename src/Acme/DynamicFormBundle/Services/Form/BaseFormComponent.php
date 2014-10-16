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


    abstract public function add(FormBuilderInterface $fb);

} 