<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace bin\blocks\forum_block;

use app\classes\render;
use app\classes\config;
use app\classes;
use app\classes\data_mapper;
use bin\models;
use app\classes\input;
/**
 * Description of forum_block
 *
 * @author User
 */
class forum_block extends render\block
{
    protected static $block_name = 'forum_block';
    
    public function getSections()
    {
        $config = config\json_config::create();
        $config->set('db_config');

        $temes_count = [];
        $messages_count = [];
        $last_temes = [];
        
        if(classes\db::Connect($config))
        {
            $sections_mapper = new models\sections_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            $sections = $sections_mapper->getSections();
            
            $temes_mapper = new models\temes_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            $messages_mapper = new models\messages_mapper(classes\db::getPDO(), new data_mapper\query_builder());

            
            
            for($j = 0; $j < count($sections); $j++)
            {
                $temes = $temes_mapper->getCountTemesBySectionId($sections[$j]->getProperty('id'));
                $temes_count[$j] = $temes->getProperty('count');
                
                $last_temes[$j] = $temes_mapper->getLastTemeBySectonid($sections[$j]->getProperty('id'));
                
                $t = $temes_mapper->getTemesBySectionId($sections[$j]->getProperty('id'));

                if(!is_array($t))
                {
                    $t = [$t];
                }
                
                $messages_count[$j] = 0;
                
                for ($i = 0; $i < count($t); $i++)
                {
                    $messages = $messages_mapper->getCountMessagesByTemeId($t[$i]->getProperty('id'));
                    (int)$messages_count[$j] += (int)$messages->getProperty('count');

                }
            }
        }
        
        //echo '<pre>';
        //var_dump($last_temes);
        //echo '</pre>';

        if(!is_array($sections))
        {
            $sections = [$sections];
        }
        
        render\block_vars::set('temes_count', $temes_count);
        render\block_vars::set('messages_count', $messages_count);
        render\block_vars::set('sections', $sections);
        render\block_vars::set('last_temes', $last_temes);
    }
    
    public function getTemes($id)
    {
        $config = config\json_config::create();
        $config->set('db_config');
        
        $messages_count = [];
        $last_message = [];
        $last_user = [];
        
        if(classes\db::Connect($config))
        {
            $temes_mapper = new models\temes_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            
            $temes = $temes_mapper->getTemesBySectionId($id);
        
            if(!is_array($temes))
            {
                $temes = [$temes];
            }
            
            $messages_map = new models\messages_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            $user_map = new models\users_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            
            foreach($temes as $key => $value)
            {
                $messages = $messages_map->getCountMessagesByTemeId($value->getProperty('id'));
                $messages_count[$key] = $messages->getProperty('count');
                $last_m = $messages_map->getLastMessageByTemeId($value->getProperty('id'));
                $last_message[$key] = $last_m;
                $last_user[$key] = $user_map->getUserById($last_m->getProperty('userid'));
                
                //var_dump($last_m);
            }
        }
        
        //var_dump($last_message);

        render\block_vars::set('messages_count', $messages_count);
        render\block_vars::set('temes', $temes);
        render\block_vars::set('last_message', $last_message);
        render\block_vars::set('last_user', $last_user);
    }
    
    public function getMessages($id)
    {
        $config = config\json_config::create();
        $config->set('db_config');
        
        if(classes\db::Connect($config))
        {
            $messages_mapper = new models\messages_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            
            $messages = $messages_mapper->getMessagesByTemeId($id);
        
            if(!is_array($messages))
            {
                $messages = [$messages];
            }
            
            $temes_map = new models\temes_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            $teme = $temes_map->getTemeById(input\session::get('tid'));
            
            $users_map = new models\users_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            
            $users_list = [];
            
            foreach ($messages as $key => $value)
            {
                $users_list[$key] = $users_map->getUserById($value->getProperty('userid'));
            }
        }
        
        //var_dump(input\session::all());
        
        render\block_vars::set('messages', $messages);
        render\block_vars::set('teme', $teme);
        render\block_vars::set('users_list', $users_list);
    }
}
