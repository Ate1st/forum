<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author User
 */
namespace helpers\auth;

use app\classes\input;
use bin\models;
use app\classes\data_mapper;

class auth 
{
    public static function set(data_mapper\IModel $user, $password)
    {
        if($user->getProperty('id') !== 0 && password_verify($password, $user->getProperty('password')))
        {
            input\session::set('id', $user->getProperty('id'));
            input\session::set('name', $user->getProperty('name'));
            input\session::set('role', $user->getProperty('role'));
            input\session::set('auth', 1);
            
            return true;
        }
        
        return false;
    }
    
    public static function isAuth()
    {
        return input\session::is('auth', 1);
    }
    
    public static function logout()
    {
        input\session::set('id', 0);
        input\session::set('name', 0);
        input\session::set('role', 0);
        input\session::set('auth', 0);
            
        return true;
    }
}
