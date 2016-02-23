<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of json_config
 *
 * @author User
 */

namespace app\classes\config;

class json_config extends config
{
    protected $config = array('config');
    protected $config_path = 'configs';

    public function set($config_name)
    {
        $config = [];
        $res = [];

        //var_dump($this->config_path.'/'.$config_name.'.json');
        
        if(file_exists($this->config_path.'/'.$config_name.'.json'))
	{
            $config = file_get_contents($this->config_path.'/'.$config_name.'.json');
            $res = json_decode($config, true);
	}
        
        $this->config[$config_name] = $res;
        
        //var_dump($res);
        }
    
    public function change($name, $value)
    {
        $this->config[$name] = $value;
    }

    public function update($config)
    {
        file_put_contents($this->config_path.'/'.$config.'.json', json_encode($this->config[$config]));
	//self::set($this->config);
    }
}
