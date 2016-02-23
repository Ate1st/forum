<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main_controller
 *
 * @author User
 */

namespace bin\controllers;

use app\classes\controller;
use app\classes\config;
use app\classes;
use app\classes\data_mapper;
use bin\models;
use app\classes\render;
use bin\blocks\users_block;
use bin\blocks\messages_block;
use app\classes\input;
use helpers\auth;

class main_controller extends controller\controller
{

    public static function index()
    { 
        $start = microtime();

        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        $users_block = users_block\users_block::create_block('app_config', 'users_block');        
        
        if(auth\auth::isAuth())
        {
            $users_block->get_users();
            render\render::setVar('user_name', $users_block->get());
        }
        else 
        {
            
        }
        
        $render->show();
        
        $end = microtime();
        echo $end - $start;  
    }
    
    public static function auth()
    {
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        $users_block = users_block\users_block::create_block('app_config', 'users_block');        
        render\render::setVar('content', $users_block->get('auth_block'));
        
        $render->show();
    }
    
    public static function actionAuth()
    {
        
        if(input\input::isempty('name') || input\input::isempty('password'))
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '3');
            render\render::setVar('message', $message->get('message'));
            return ['route' => ['\\bin\\controllers\\main_controller', 'reg'], 'params' => []];
        }
        
        $params = input\input::only('name', 'password');

        
        $config = config\json_config::create();
        
        $config->set('db_config');
        
        classes\db::Connect($config);

        $users_mapper = new models\users_mapper(classes\db::getPDO(), new data_mapper\query_builder());
        $user_model = $users_mapper->getUserByName($params['name']);
        
        
        auth\auth::set($user_model, $params['password']);
        
        $message = messages_block\messages_block::create_block('app_config', 'messages_block');        
        
        if(!auth\auth::isAuth())
        {
            $message->set_mess('alert-danger', '1');
            render\render::setVar('message', $message->get('message'));
        }
        else 
        {
            $message->set_mess('alert-success', '2');
            render\render::setVar('message', $message->get('message'));
        }
        
        return ['route' => ['\\bin\\controllers\\main_controller', 'index'], 'params' => []];
    }

    public static function actionLogout()
    {
        auth\auth::logout();
        return ['route' => ['\\bin\\controllers\\main_controller', 'index'], 'params' => []];
    }
    
    public static function reg()
    {
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        $users_block = users_block\users_block::create_block('app_config', 'users_block');        

        //$users_block->auth();
        render\render::setVar('content', $users_block->get('registration'));
        
        $render->show();
    }

    public static function actionReg()
    {
        if(input\input::isempty('name') || input\input::isempty('password'))
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '3');
            render\render::setVar('message', $message->get('message'));
        }
        
        
        
        $params = input\input::only('name', 'password');
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);

        $config = config\json_config::create();
        $config->set('db_config');
        
        classes\db::Connect($config);

        $users_mapper = new models\users_mapper(classes\db::getPDO(), new data_mapper\query_builder());
        $user_model = $users_mapper->getUserByName($params['name']);
        
        if($user_model->exists())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '4');
            render\render::setVar('message', $message->get('message'));
            
            return ['route' => ['\\bin\\controllers\\main_controller', 'reg'], 'params' => []];
        }
        
        $user_model->setProperties($params);
        $users_mapper->addUser($user_model);

        return ['route' => ['\\bin\\controllers\\main_controller', 'index'], 'params' => []];
    }

}
