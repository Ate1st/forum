<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\data_mapper;

use app\classes\render;
use app\classes\config;
use bin\blocks\messages_block;
/**
 * Description of mapper
 *
 * @author User
 */
class mapper 
{
    private $pdo = null;
    private $result = null;
    private $options = array(\PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL);
    private $prepared = null;
    protected $query_builder = null;

    public function __construct(\PDO $pdo, \app\classes\data_mapper\query_builder $qb)
    {
        $this->pdo = $pdo;  
        $this->query_builder = $qb;
    }
    
    public function prepare($params, $options = null)
    {    
        if($options != null)
        {
            $this->options = $options;
        }
        $this->prepared = $this->pdo->prepare($this->query_builder->get_query(), $this->options);
          
        //var_dump($this->prepared);
        //var_dump($this->query_builder);
        if(!$this->prepared)
        {
            $message = messages_block\messages_block::create_block('app_config', 'messages_block');
            
            $message->set_mess('alert-danger', '3');
            render\render::setVar('message', $message->get('message'), '{'.$this->query_builder->get_query().'}');
            
            //echo 'Ошибка SQL {'.$this->query_builder->get_query().'}';
            return false;
            //die;
        }
        $this->prepared->execute($params);
        $this->result = $this->prepared->fetchAll(\PDO::FETCH_NAMED);
        
        
        $this->query_builder->clear_query();
        //var_dump($this->result);
        
        return $this;
    }
    
    public function set($params, $options = null)
    {
        $last_id = 0;
        
        if($options != null)
        {
            $this->options = $options;
        }
        $this->prepared = $this->pdo->prepare($this->query_builder->get_query(), $this->options);

            if(!$this->prepared)
            {
                echo 'Ошибка SQL {'.$this->query_builder->get_query().'}';
                return $last_id;
            }
            
            $this->prepared->execute($params);
            $last_id = $this->pdo->lastInsertId(); 
            $this->query_builder->clear_query();
        return $last_id;
    }
    
    public function get(IModel $model)
    {         
        if(count($this->result) === 0)
        {
            return $model;
        }

        return $model->setProperties($this->result);
    }
}
