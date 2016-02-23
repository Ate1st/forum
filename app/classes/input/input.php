<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of input
 *
 * @author User
 */
namespace app\classes\input;

class input implements IInput
{
    protected static $values = [];
    
    public static function get($name)
    {
        if(array_key_exists($name, self::$values))
        {
            return self::$values[$name];
        }
        
        return null;
    }
    
    public static function set($name, $value)
    {
        self::$values[$name] = $value;
        
    }
    
    public static function has($name)
    {
        if(array_key_exists($name, self::$values))
        {
            return true;
        }
        
        return false;
    }
    
    public static function all()
    {
        return self::$values;
    }
    
    public static function only()
    {
        $tmp = [];
        
        $numargs = func_num_args();
        $arg_list = func_get_args();
        
        for($i = 0; $i < $numargs; $i++)
        {
            if(array_key_exists($arg_list[$i], self::$values))
            {
                $tmp[$arg_list[$i]] = self::$values[$arg_list[$i]];
            }
        }
        
        return $tmp;
    }
    
    public static function except()
    {
        
    }
    
    public static function isempty($name)
    {
        if(!self::has($name) || empty(self::$values['name']))
        {
            return true;
        }
        
        return false;
    }
}
