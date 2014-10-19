<?php

namespace Acme\DynamicFormBundle\Controller;

use Acme\DynamicFormBundle\Entity\FieldConstraint;
use Acme\DynamicFormBundle\Services\Form\FormComponentText;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form=$this->get("repo.form")->getFormById(1);

        $fields=$form->getFields();

        $components=array();

        foreach($fields as $f)
        {
           // var_dump($f->getFieldName());
            $constraints=$f->getConstraints();
            $fieldClass=$f->getFieldType();

            foreach($constraints as $c)
            {
              //  var_dump($c->getId());
                $components[]=new $fieldClass($f);
                break;
            }
        }



        $errors="";

        $form=$this->get("services.formbuilder")->generateForm($components);

        $form=$form->add('save','submit',array('label'=>'Submit'))
            ->getForm();
//        $data=array();
//        $form=$this->createFormBuilder($data)
//            ->add('field1','text')
////            ->add('field2','number')
//            ->add('options','choice',
//                array('choices'=>
//                    array(
//                        "Label1"=>"Value1",
//                        "Label2"=>"Value2",
//                        "Label3"=>"Value3"
//
//                    )))
//            ->add('save','submit',array('label'=>'Submit'))
//            ->getForm();
//        $form->isValid();
      //  $form->handleRequest($request);

        if($request->isMethod('POST'))
        {

            $form->bind($request);
            $data=$form->getData();

            if($form->isValid())
            {
                return $this->render('AcmeDynamicFormBundle:Default:success.html.twig', array('form' => $form->createView(),'data_dump' => print_r($data,true),'errors'=>$errors));

            }else{
                $errors=$form->getErrorsAsString();
                return $this->render('AcmeDynamicFormBundle:Default:index.html.twig', array('form' => $form->createView(),'data_dump' => print_r($data,true),'errors'=>$errors));
            }

        }
        else{

            return $this->render('AcmeDynamicFormBundle:Default:index.html.twig', array('form' => $form->createView(),'errors'=>$errors));
        }
//
    }
}
