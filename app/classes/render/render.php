<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of render
 *
 * @author User
 */

namespace app\classes\render;

use app\classes\config;
 
class render 
{
    protected $cfg = null;
    protected $tpl_path = null;
    protected $content = [];
    private static $vars = [];

    public static function getVar($name)
    {
        if(!empty(self::$vars[$name]))
        {
            return self::$vars[$name];
        }
        return null;
    }

    public static function setVar($name, $value)
    {
        self::$vars[$name] = $value;
    }
    public static function create()
    {
        return new static;
    }

    public function set_config(config\json_config $config)
    {
        $this->tpl_path = $config->get('app_config')['tpl_path'];
        $tpl_config = config\json_config::create();
        $tpl_config->set_path($this->tpl_path);
        $tpl_config->set('tpl_config');
        $this->cfg = $tpl_config->get('tpl_config');
    }

    public function show($tpl = null)
    {
        ob_start();
        if($tpl === NULL)
        {
            $tpl = 'index';
        }
        
        if(file_exists($this->tpl_path.$this->cfg[$tpl]))
        {
            require $this->tpl_path.$this->cfg[$tpl];
        }
        else 
        {
            echo 'Шаблон не найден';
            die;
        }

        $res = ob_get_clean();
        
        echo $res;
    }
}
