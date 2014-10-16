<?php

namespace Acme\DynamicFormBundle\Controller;

use Acme\DynamicFormBundle\Services\Form\FormComponentText;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $components=array(
            new FormComponentText("test1"),
            new FormComponentText("test2"));

        $form=$this->get("services.formbuilder")->generateForm($components);

        $form=$form->add('save','submit',array('label'=>'Submit'))
            ->getForm();
       // var_dump($form);
      //  die();

//        $data=array();
//        $form=$this->createFormBuilder($data)
//            ->add('field1','text')
//            ->add('field2','number')
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
      //  $form->handleRequest($request);

        if($request->isMethod('POST'))
        {
            $form->bind($request);
            $data=$form->getData();
            //var_dump($data);
            return $this->render('AcmeDynamicFormBundle:Default:success.html.twig', array('data_dump' => print_r($data,true)));
        }
        else{

            return $this->render('AcmeDynamicFormBundle:Default:index.html.twig', array('form' => $form->createView()));
        }
//
    }
}
