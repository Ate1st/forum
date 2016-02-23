<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\input;

/**
 *
 * @author User
 */
interface IInput 
{
    public static function get($name);
    public static function set($name, $value);
    public static function has($name);
    public static function all();
    public static function only();
    public static function except();

}
