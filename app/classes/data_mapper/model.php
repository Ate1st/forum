<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author User
 */

namespace app\classes\data_mapper;

abstract class model implements IModel
{
    private $model_info = null;


    public static function create()
    {
        return new static();
    }
    
    private function setModelInfo()
    {
        $this->model_info = model_info::create();
        $this->model_info->createClass($this->model_name);
        $this->model_info->setProperties();
        $this->model_info->setInstance($this);
    }

    public function setProperties($params)
    {
        $this->setModelInfo();
        return $this->model_info->setValues($params);
    }
    
    public function setProperty($name, $value)
    {
        $this->setModelInfo();
        return $this->model_info->setValue($name, $value);
    }
    
    public function getProperty($name)
    {
        $this->setModelInfo();
        return $this->model_info->getValue($name);
    }
    
    public function getProperties()
    {
        $this->setModelInfo();
        return $this->model_info->getValues();
    }
    
    public function exists()
    {
        if($this->getProperty('id'))
        {
            return true;
        }
        
        return false;
    }
}
