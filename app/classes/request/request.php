<?php

namespace app\classes\request;

use app\classes\input;

class request implements IRequest
{
    private static $route;
    private static $params;
    
    public static function create()
    {
        return new static;
    }

    public function init($config)
    {
        $request = $_REQUEST; 
        if(isset($request['route']))
        {
            self::$route = explode('/', array_shift($request));
            
            if(empty(self::$route[1]))
            {
                self::$route[1] = $config['default_action'];
            }
        }
        else
        {
            self::$route = [$config['default_controller'], $config['default_action']];
        }
        
        foreach ($request as $key => $value)
        {
            input\input::set($key, $value);
        }
    }
    
    public function getRoute()
    {
        return self::$route;
    }
    
    public function set_default_route($config)
    {
        self::$route = [$config->get('app_config')['default_controller'], $config->get('app_config')['default_action']];
    }

}