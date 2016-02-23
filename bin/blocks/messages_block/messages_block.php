<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of messages_block
 *
 * @author User
 */
namespace bin\blocks\messages_block;

use app\classes\render;
use app\classes\config;
use app\classes;
use app\classes\data_mapper;
use bin\models;
use app\classes\input;


class messages_block extends render\block
{
    protected static $block_name = 'messages_block';
    
    public function set_mess($message_type, $message_code, $info = null)
    {
        render\block_vars::set_block(self::$block_name);
        render\block_vars::set('message_type', $message_type);
        render\block_vars::set('message', self::message_codes($message_code));  
        render\block_vars::set('info', $info);
        
        //var_dump(render\block_vars::all());
    }
    
    private static function message_codes($code)
    {
        $mess = [
            '1' => 'Пользователь не найден',
            '2' => 'Успешная авторизация',
            '3' => 'Заполните все поля',
            '4' => 'Логин занят',
            '5' => 'У Вас недостачно прав для просмотра форума. Необходимо зарегистрироваться и/или авторизоваться',
            '6' => 'Форум с таким названием уже существует'
        ];
        
        return $mess[$code];
    }
}
