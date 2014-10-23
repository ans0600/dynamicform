<?php

namespace Acme\DynamicFormBundle\Controller;

use Acme\DynamicFormBundle\Entity\FieldConstraint;
use Acme\DynamicFormBundle\Services\Form\FormComponentText;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DataGridController extends Controller
{
    public function indexAction(Request $request)
    {
      $page=$request->query->get('page')?$request->query->get('page'):1;
      $limit=$request->query->get('limit')?$request->query->get('limit'):10;
        $orderBy=$request->query->get('orderBy')?$request->query->get('orderBy'):null;
        $dir=$request->query->get('dir')?$request->query->get('dir'):null;
      $dataGrid=$this->get('service.datagrid.datagrid_service')->getDataGrid("AcmeDynamicFormBundle:Field",$page,$limit,$orderBy,$dir);


      return $this->render('AcmeDynamicFormBundle:Default:datagrid_index.html.twig', array('datagrid'=>$dataGrid));
    }
}
