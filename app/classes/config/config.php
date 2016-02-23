<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author User
 */

namespace app\classes\config;

abstract class config implements IConfig
{
    protected $config = [];
    protected $config_path = 'configs';

    public static function create()
    {
        return new static;
    }

    public function set_path($config_path) 
    {
        $this->config_path = $config_path;
    }

    public function set($config = null)
    {
        $this->config = $config;
    }
    
    public function get($name = null)
    {
        if($name)
        {
            return $this->config[$name];
        }
        return $this->config;
    }
    
    
}
