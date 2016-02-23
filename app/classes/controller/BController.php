<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author User
 */

namespace app\classes\controller;


use app\classes\request;
use bin\controllers;
use helpers;

abstract class BController implements IController
{
    private $controller = null;
    private $action = null;
    private $params = [];

    public static function create()
    {
        return new static;
    }
    
    public function call(request\IRequest $request, $params = [])
    {
        $this->params = $params;
        $route = $request->getRoute();
        $this->controller = $route[0].'_controller';
        $this->action = $route[1];

        if(!class_exists('bin\\controllers\\'.$this->controller))
        {
            throw new \Exception('Controller not exists');
        }
        if(!method_exists('bin\\controllers\\'.$this->controller, $this->action))
        {
            //echo 'asd';
            throw new \Exception('Action not exists');
        }
        
        if(stristr($this->action, 'action') !== false)
        {
            $callback = call_user_func_array(['bin\\controllers\\'.$this->controller, $this->action], $this->params);
            call_user_func_array($callback['route'], $callback['params']);
            return true;
        }
        if(stristr($this->action, 'ajax') !== false)
        {
            call_user_func_array(['bin\\controllers\\'.$this->controller, $this->action], $this->params);
            return true;
        }

        //var_dump($route);
            call_user_func_array(['bin\\controllers\\'.$this->controller, $this->action], $this->params);  
            
    }
    
    public static function callStatic($controller = 'main_controller', $action = 'index')
    {
        call_user_func_array(['bin\\controllers\\'.$controller, $action], []); 
    }
}
