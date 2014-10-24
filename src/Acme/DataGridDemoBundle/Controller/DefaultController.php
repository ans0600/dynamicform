<?php

namespace Acme\DataGridDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      $page=$request->query->get('page')?$request->query->get('page'):1;
      $limit=$request->query->get('limit')?$request->query->get('limit'):10;
      $orderBy=$request->query->get('orderBy')?$request->query->get('orderBy'):null;
      $dir=$request->query->get('dir')?$request->query->get('dir'):null;
      $dataGrid=$this->get('service.datagrid.datagrid_service')->getDataGrid("AcmeDataGridBundle:TestUserAddress",$page,$limit,$orderBy,$dir);


      return $this->render('AcmeDataGridDemoBundle:Default:datagrid_index.html.twig', array('datagrid'=>$dataGrid));
    }
}
