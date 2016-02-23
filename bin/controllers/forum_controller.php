<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bin\controllers;

use app\classes\controller;
use app\classes\config;
use app\classes;
use app\classes\data_mapper;
use bin\models;
use app\classes\render;
use bin\blocks\forum_block;
use bin\blocks\messages_block;
use app\classes\input;
use helpers\auth;
/**
 * Description of forum_controller
 *
 * @author User
 */
class forum_controller extends controller\controller
{
    public static function index()
    {
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        if(!auth\auth::isAuth())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '5');
            render\render::setVar('message', $message->get('message'));

            self::callStatic('main_controller', 'index');
            die;
        }
        
        $forum_block = forum_block\forum_block::create_block('app_config', 'forum');

        $forum_block->getSections();
        
        
        render\render::setVar('content', $forum_block->get('new_forum'));
        render\render::setVar('content1', $forum_block->get('sections'));
        
        $render->show();
    }
    
    public static function forumAdd()
    {
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        if(!auth\auth::isAuth())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '5');
            render\render::setVar('message', $message->get('message'));

            self::callStatic();
            die;
        }
        
        $forum_block = forum_block\forum_block::create_block('app_config', 'forum');

        render\render::setVar('content', $forum_block->get('add'));
        
        $render->show();
    }

    public static function actionForumAdd()
    {
        $params = input\input::only('name');

        $config = config\json_config::create();
        $config->set('db_config');
        
        classes\db::Connect($config);
        
        $sections_mapper = new models\sections_mapper(classes\db::getPDO(), data_mapper\query_builder::create());
        $section = $sections_mapper->getSectionByName($params['name']);
        
        if($section->exists())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '6');
            render\render::setVar('message', $message->get('message'));

            self::callStatic('forum_controller', 'add');
            die;
        }
        
        $section->setProperties($params);
        $sections_mapper->addSection($section);
        
        return ['route' => ['\\bin\\controllers\\forum_controller', 'index'], 'params' => []];
    }
    
    public static function forum()
    {
        if(input\input::isempty('sectionid'))
        {
            $params = input\input::only('sectionid');
        }
        else
        {
            $params['sectionid'] = input\session::get('sectionid');
        }
        
        
        //var_dump($params);
        
        
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        if(!auth\auth::isAuth())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '5');
            render\render::setVar('message', $message->get('message'));

            self::callStatic();
            die;
        }
        
        $forum_block = forum_block\forum_block::create_block('app_config', 'forum');

        $forum_block->getTemes($params['sectionid']);
        
        input\session::set('sectionid', $params['sectionid']);
        
        
        render\render::setVar('content', $forum_block->get('new_teme'));
        render\render::setVar('content1', $forum_block->get('temes'));
        
        $render->show();
    }
    
    public static function themeAdd()
    {
        $params = input\input::only('sectionid');
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        if(!auth\auth::isAuth())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '5');
            render\render::setVar('message', $message->get('message'));

            self::callStatic();
            die;
        }
        
        $teme_block = forum_block\forum_block::create_block('app_config', 'forum');

       
        
        render\render::setVar('content', $teme_block->get('add_teme'));
        
        $render->show();
    }
    
    public static function actionTemeAdd()
    {
        $params = input\input::only('name');

        $sectionid = input\session::get('sectionid');

        $config = config\json_config::create();
        $config->set('db_config');
        
        classes\db::Connect($config);
        
        $temes_mapper = new models\temes_mapper(classes\db::getPDO(), data_mapper\query_builder::create());

        $teme = new models\temes_model();
        $teme->setProperties($params);
        $teme->setProperty('sectionid', $sectionid);
        $teme->setProperty('createdate', date('Y-m-d H:i:S'));
        $teme->setProperty('userid', input\session::get('id'));
        //var_dump($teme);
        
        $temes_mapper->addTeme($teme);
        
        return ['route' => ['\\bin\\controllers\\forum_controller', 'forum'], 'params' => ['id=' => '1']];
    }
    
    public static function teme()
    {
        
        if(input\input::isempty('tid'))
        {
            $params = input\input::only('tid');
        }
        else
        {
            $params['tid'] = input\session::get('tid');
        }
        
        //var_dump($params);
        
        //$params = input\input::only('sectionid');
        $config = config\json_config::create();
        $config->set('app_config');
        
        $render = render\render::create();
        $render->set_config($config);
        
        if(!auth\auth::isAuth())
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            $message->set_mess('alert-danger', '5');
            render\render::setVar('message', $message->get('messages'));

            self::callStatic();
            die;
        }
        
        input\session::set('tid', $params['tid']);
        
        $messages_block = forum_block\forum_block::create_block('app_config', 'forum');

        $messages_block->getMessages($params['tid']);
        
        render\render::setVar('content', $messages_block->get('messages'));

        $render->show();
    }
    
    public static function actionAdd_message()
    {
        $params = input\input::only('tid', 'text');
        $params['temeid'] = $params['tid'];

        //var_dump($params);
        
        $config = config\json_config::create();
        $config->set('db_config');
        
        classes\db::Connect($config);
        
        $message_map = new models\messages_mapper(classes\db::getPDO(), data_mapper\query_builder::create());
        $message = models\messages_model::create();
        $message->setProperties(['temeid' => $params['temeid'],
            'userid' => input\session::get('id'),
            'createdate' => date('Y-m-d H:i:S')]);
        
        $message->setMessage($params['text']);
        
        $message_map->addMessage($message);
        
        return ['route' => ['\\bin\\controllers\\forum_controller', 'teme'], 'params' => []];
    }
}


