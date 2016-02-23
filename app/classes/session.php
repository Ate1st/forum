<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of session
 *
 * @author vasilyevab
 */
class session 
{
    public static function start()
    {
        $SID = session_id();

        if(empty($SID))
        {
            session_start();
        }
    }
    
    public static function getVal($val_name)
    {
        if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$val_name]))
        {
            return $_SESSION[$val_name];
        }
        
        return FALSE;
       //return  session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$val_name]) ? $_SESSION[$val_name] : FALSE;
    }
    
    public static function setVal($val_name, $value)
    {
        session_status() === PHP_SESSION_ACTIVE ? $_SESSION[$val_name] = $value : FALSE;
    }
    
    public static function setValArray($val_array = [])
    {
        if(session_status() === PHP_SESSION_ACTIVE)
        {
            foreach($val_array as $key => $value)
            {
                $_SESSION[$key] = $value;
            }
            return TRUE;
        }
        return FALSE;
    }

    public static function delVal($val_name)
    {
        if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$val_name]))
        {
            unset($_SESSION[$val_name]);
            return TRUE;
        }
        
        return FALSE;
    }
    
    public static function delValArray($val_array = [])
    {
        if(session_status() === PHP_SESSION_ACTIVE)
        {
            foreach($val_array as $key => $value)
            {
                unset($_SESSION[$key]);
            }
            return TRUE;
        }
        return FALSE;
    }

    public static function close()
    {
        session_write_close();
    }
}
