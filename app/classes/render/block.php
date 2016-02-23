<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\render;

use app\classes\config;

/**
 * Description of block
 *
 * @author User
 */
class block extends render
{
    protected static $conf = null;
    protected static $block_tpl_path = null;
    protected static $block_name = null;
    
    protected static $app_config;
    
    protected $values = [];

    public static function create_block($app_config_name, $block_name)
    {
        self::$conf = null;
        
        self::$block_name = $block_name;
        $config = config\json_config::create();
        $config->set($app_config_name);
        self::$block_tpl_path = $config->get('app_config')['tpl_path'];
        $block_config = config\json_config::create();
        $block_config->set_path(self::$block_tpl_path.'block_views/'.$block_name.'/');
        
        //var_dump(self::$block_tpl_path.'block_views/'.$block_name.'/');
        
        $block_config->set('config'); 
        
        
        
        self::$conf = $block_config->get('config');
        
     
        //var_dump($block_config);
        
        return new static;
    }
    
    //public function set_config(config\json_config $config)
    //{
        //self::$tpl_path = $config->get('app_config')['tpl_path'];
        //$block_config = config\json_config::create();
        //$block_config->set_path($this->tpl_path.'block_views/'.$this->block_name.'/');
        //$block_config->set('config');
        //self::$cfg = $block_config->get('config');
    //}
    
    public function show($tpl = null)
    {
        ob_start();
        if($tpl === NULL)
        {
            $tpl = 'index';
        }
        
        
        
        if(file_exists(self::$block_tpl_path.'block_views/'.$this->block_name.'/'.self::$conf[$tpl]))
        {
            require self::$block_tpl_path.'block_views/'.$this->block_name.'/'.self::$conf[$tpl];
        }
        else 
        {
            echo 'Шаблон не найден';
            die;
        }

        $res = ob_get_clean();
        
        echo $res;
    }
    
    public function get($tpl = null)
    {
        ob_start();
        if($tpl === NULL)
        {
            $tpl = 'index';
        }
        
        //var_dump(self::$block_tpl_path.'block_views/'.self::$block_name.'/'.self::$conf[$tpl]);
        
        //var_dump(self::$conf);

        if(file_exists(self::$block_tpl_path.'block_views/'.self::$block_name.'/'.self::$conf[$tpl]))
        {
            require self::$block_tpl_path.'block_views/'.self::$block_name.'/'.self::$conf[$tpl];
        }
        else 
        {
            echo 'Шаблон не найден';
            die;
        }

        $res = ob_get_clean();
        
        return $res;
    }
}
