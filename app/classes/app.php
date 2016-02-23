<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.07.2015
 * Time: 21:21
 */

//require_once 'autoload.php';

namespace app\classes;

use app\classes\config;
use app\classes\request;

class app
{

    public static function init()
    {
        $app_config = config\json_config::create();
        $app_config->set('app_config');
        
        $request = request\request::create();
        $request->init($app_config->get()['app_config']);
 
        return $request;
    }

}