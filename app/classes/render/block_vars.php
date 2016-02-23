<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\render;

/**
 * Description of block_vars
 *
 * @author User
 */
class block_vars 
{
    private static $vars = [];
    private static $block_name = null;

    public static function set_block($name)
    {
        self::$block_name = $name;
    }

    public static function get($name)
    {
        if(!empty(self::$vars[self::$block_name][$name]))
        {
            return self::$vars[self::$block_name][$name];
        }
        return null;
    }
    
    public static function getJson($name)
    {
        if(!empty(self::$vars[self::$block_name][$name]) && is_array(self::$vars[self::$block_name][$name]))
        {
            return json_decode(self::$vars[self::$block_name][$name]);
        }
        return null;
    }
    
    public static function set($name, $value)
    {
        self::$vars[self::$block_name][$name] = $value;
    }
    
    public static function all()
    {
        return self::$vars;
    }
}
