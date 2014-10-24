<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 10/24/14
 * Time: 11:52 AM
 */

namespace Acme\DataGridBundle\Services\Utils;


class EntityFieldUtil {


 public static function getFieldName($fieldName)
 {
   return preg_replace("/[\\_\\*\\-]/", "", $fieldName);

 }

  public static function getEntityGetterName($fieldName)
  {
    $fName=self::getFieldName($fieldName);
    return 'get'.ucfirst($fName);

  }

} 