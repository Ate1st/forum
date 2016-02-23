<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bin\models;

use app\classes\data_mapper;
use bin\models;
/**
 * Description of messages_mapper
 *
 * @author User
 */
class messages_mapper extends data_mapper\mapper
{
    public function getMessages()
    {
        $this->query_builder->select(['*'])->from(['messages']);
        $this->prepare([]);
        return $this->get(models\messages_model::create());
    }
    
    public function getLastMessageByTemeId($id)
    {
        $this->query_builder->select(['*'])->from(['messages'])->
                where([['temeid = ' => ':temeid']])->
                order_by('createdate', 'desc')->limit('1');
        $this->prepare([':temeid' => $id]);
        return $this->get(models\messages_model::create());
    }
    
    public function getMessagesByTemeId($id)
    {
        $this->query_builder->select(['*'])->from(['messages'])->where([['temeid = ' => ':temeid']]);
        $this->prepare([':temeid' => $id]);
        return $this->get(models\messages_model::create());
    }
    
    public function getCountMessagesByTemeId($id)
    {
        $this->query_builder->select(['Count(*) as count'])->from(['messages'])->where([['temeid = ' => ':temeid']]);
        $this->prepare([':temeid' => $id]);
        
        return $this->get(models\messages_model::create());
    }
    
    public function addMessage(data_mapper\IModel $message)
    {
        //var_dump($user);
        if($message->exists())
        {
            $this->query_builder->update('messages')->set([
                ['text=' => ':text'], ['temeid =' => ':temeid'], ['createdate =' => ':createdate'], ['userid =' => ':userid']              
                ])->where([['id =' => ':id']]);
            
            $this->set([
                ':id' => $message->getProperty('id'),
                ':text' => $message->getProperty('text'),
                ':temeid' => $message->getProperty('temeid'),
                ':createdate' => $message->getProperty('createdate'),
                ':userid' => $message->getProperty('userid')
                 ]);
        }
        else 
        {
            $this->query_builder->insert('messages', ['text', 'temeid', 'createdate', 'userid'])->
                    values([':text', ':temeid', ':createdate', ':userid']);
            $this->set([':text' => $message->getProperty('text'), 
                ':temeid' => $message->getProperty('temeid'), 
                ':createdate' => $message->getProperty('createdate'),
                ':userid' => $message->getProperty('userid')]);
        }
       
    }
}
