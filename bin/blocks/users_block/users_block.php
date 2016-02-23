<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users_block
 *
 * @author User
 */

namespace bin\blocks\users_block;

use app\classes\render;
use app\classes\config;
use app\classes;
use app\classes\data_mapper;
use bin\models;
use app\classes\input;


class users_block extends render\block
{
    protected static $block_name = 'users_block';
    
    public function get_users()
    {
        $config = config\json_config::create();
        $config->set('db_config');

        if(classes\db::Connect($config))
        {
            $users_mapper = new models\users_mapper(classes\db::getPDO(), new data_mapper\query_builder());
            $user = $users_mapper->getUserById(input\input::get('id'));
        }
        
        render\block_vars::set('user', $user);
    }

}
