<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of messages
 *
 * @author vasilyevab
 */
class messages 
{
    private static $message = [];
    
    public static function set_message($code, $type)
    {
        self::$message[$code] = $type;
    }
    
    public static function get_message()
    {
        $res = self::$message;
        self::$message = [];
        return $res;
    }
    
    public static function show_message()
    {
        ob_start();

        require config::get_config('app_path').'/bin/bloks/messages/messages.php';
        
        $contents = ob_get_clean();
        
        return $contents;
    }
}
