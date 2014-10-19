<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 19/10/14
 * Time: 5:59 PM
 */

namespace Acme\DynamicFormBundle\Services\Util;


class Utils{

   public static function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = self::object_to_array($val);
            }
        }
        else $new = $obj;
        return $new;
    }

} 