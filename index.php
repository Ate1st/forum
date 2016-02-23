<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22.07.2015
 * Time: 17:13
 */

use app\classes;
use app\classes\request;
use app\classes\config;
use app\classes\controller;


error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'app/classes/autoload/autoload.php'; 

$request = classes\app::init();

$controller = controller\controller::create();
try
{
    $controller->call($request);
} 
catch (Exception $ex) 
{
    helpers\classInfo::getErrorCode($ex, 'app\\classes\\controller\\');
    $app_config = config\json_config::create();
    $app_config->set('app_config');

    //var_dump($app_config);
    
    $request->set_default_route($app_config);
    
    var_dump($request);
    
    $controller->call($request);
}
