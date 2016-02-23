<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classInfo
 *
 * @author User
 */

namespace helpers;

class classInfo 
{
    private static $reflect = null;
    private static $method = null;
    private static $res = null;

    public static function create($className)
    {
        self::$reflect = new \ReflectionClass($className);
    }
    
    public static function setMethod($methodName)
    {
        if(self::$reflect)
        {
            self::$method = self::$reflect->getMethod($methodName);
        }
    }

    public static function getClassInfo()
    {
        if(self::$reflect)
        {
            echo '<pre>';
            \Reflection::export(self::$reflect);
            echo '</pre>';
        }
    }
    
    public static function getClassCode()
    {
        if(self::$reflect)
        {
            $path = self::$reflect->getFileName();
            $lines = @file($path);
            $from = self::$reflect->getStartLine();
            $to = self::$reflect->getEndLine();
            $len = $to - $from + 1;
            echo '<pre>';
            echo implode(array_slice($lines, $from - 1, $len));
            echo '</pre>';
        }
    }

    public static function getErrorCode(\Exception $ex, $namespace)
    {
        $f = $ex->getFile();
        $p = explode('\\', $f);
        $c = explode('.', array_pop($p));
        $l = $ex->getLine();
        
        self::create($namespace.$c[0]);
        
        
        $path = self::$reflect->getFileName();
            $lines = @file($path);
            $from = (int)$l - 5;
            $to = (int)$l + 5;
            $len = $to - $from + 1;
            
            $lines[$from + 4] = '<font color="red"><b>'.$lines[$from + 4].'</b></font>';
            self::$res .= 'Exception in '.self::$reflect->getFileName().': <br>';
            self::$res .= '<pre>';
            self::$res .= implode(array_slice($lines, $from, $len));
            self::$res .= '</pre>';
            self::$res .= 'Trase: <font color="red"><b>';
            self::$res .= $ex->getTraceAsString();
            self::$res .= '</b></font>';
    }
    
    public static function getRes()
    {
        echo self::$res;
        self::$res = null;
    }
}
