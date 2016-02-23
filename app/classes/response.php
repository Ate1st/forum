<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.08.2015
 * Time: 19:17
 */
class response 
{
    private static $dataGET = [];
    private static $dataPOST = [];
    public $declared = 1;
    private $hidden = 2;

    public static function redirect($page)
    {
        header('Location: /'.$page);
    }
    
    private static function get()
    {
        return $_GET;
    }
    
    private static function post()
    {
        return $_POST;
    }
    
    public static function setParams()
    {
        self::$dataGET = self::get();
        self::$dataPOST = self::post();
    }
    
    public static function _GET($name)
    {
        return isset(self::$dataGET[$name]) ? self::$dataGET[$name] : FALSE;
    }
    
    public static function _POST($name)
    {
        return isset(self::$dataPOST[$name]) ? self::$dataPOST[$name] : FALSE;
    }
    
    public static function getParams()
    {
        return ['get' => self::$dataGET, 'post' => self::$dataPOST];
    }
    
}