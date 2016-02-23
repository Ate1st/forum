<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\input;

/**
 * Description of session
 *
 * @author User
 */
class session extends input implements IInput
{
    //protected static $value = [];
    
    public static function start()
    {
        $sid = session_id();
        if(empty($sid))
        {
            session_start();
        }
    }
    
    public static function update()
    {
        self::$values = $_SESSION;
    }
    
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
        self::update();   
    }
    
    public static function get($name)
    {
        self::start();
        self::update();
        if(self::has($name))
        {
            return self::$values[$name];
        }
        
        return null;
    }
    
    public static function has($name)
    {
        self::start();
        self::update();
        return parent::has($name);  
    }
    
    public static function only()
    {
        self::start();
        self::update();
        
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

    public static function is($key, $value)
    {
        if(self::has($key))
        {
            if(self::get($key) == $value)
            {
                return true;
            }
        }
        
        return false;
    }
    
    public static function all()
    {
        self::start();
        self::update();
        return parent::all();
    }
}
