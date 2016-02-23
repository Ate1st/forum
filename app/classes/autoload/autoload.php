<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function _autoload($class_name) 
{
   
    if(preg_match('/\\\\/', $class_name))
    {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
    }
    
    //echo $class_name;
    
    if(file_exists($class_name.'.php'))
    {
        require_once $class_name.'.php';
    }
    
}

spl_autoload_register('_autoload');