<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bin\models;
use app\classes\data_mapper;
/**
 * Description of messages_model
 *
 * @author User
 */
class messages_model extends data_mapper\model implements data_mapper\IModel
{
    protected $model_name = 'bin\\models\\messages_model';
    protected $id = 0;
    protected $temeid = 0;
    protected $userid = 0;
    protected $createdate = 0;
    protected $text = 0;
    protected $count = 0;
    
    public function setMessage($text)
    {
        $this->text = htmlspecialchars($text);
    }
    
    public function getShortMessage()
    {
        return substr_replace($this->text, '', 200, strlen($this->text));
    }
}
