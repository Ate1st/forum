<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\classes\data_mapper;

/**
 * Description of model_info
 *
 * @author User
 */
class model_info
{
    protected $ref_class = null;
    protected $instance = null;
    protected $property = null;
    protected $properties = null;
    protected $instance_array = [];
    
    public static function create()
    {
        return new static();
    }

    public function createClass($class_name)
    {
        $this->ref_class = new \ReflectionClass($class_name);
    }
    
    public function setProperties()
    {
        $this->properties = $this->ref_class->getProperties();
    }

    public function getProperties()
    {
        return $this->properties;
    }
    
    public function setProperty($name)
    {
        $this->property = $this->ref_class->getProperty($name);
        $this->property->setAccessible(true);
        $prop->setValue($this->instance, $value);
    }
    
    public function getProperty($name)
    {
        return $this->ref_class->getProperty($name);
    }

    public function setValue($name, $value)
    {
        $prop = $this->ref_class->getProperty($name);
        $prop->setAccessible(true);
        $prop->setValue($this->instance, $value);
        return $this->instance;
    }

    public function setValues($values = [])
    {
        if($values == null)
        {
            echo 'Ошибка заполнения модели {'.$this->ref_class->getName().'}, переданные параметры равны null';
            return false;
        }

        foreach ($values as $key => $value)
        {
            
            //var_dump(count($values));
            
            if(!is_array($value))
            {
                //echo 'asd';
                
                $prop = $this->ref_class->getProperty($key);
                $prop->setAccessible(true);
                $prop->setValue($this->instance, $value);
                //return $this->instance;
            }
            else
            {
                $this->createInstance();
            
                foreach ($value as $k => $v)
                {
                    $prop = $this->ref_class->getProperty($k);
                    $prop->setAccessible(true);
                    $prop->setValue($this->instance, $v);
                }
            }

            $this->instance_array[$key] = $this->instance;
        }
        if(count($values) === 1)
        {
            return $this->instance;
        }
        return $this->instance_array;
    }
    
    public function getValue($name)
    {
        $props = $this->ref_class->getProperties();
        
        //var_dump($props);
        
        $exists = false;
        
        foreach ($props as $pr)
        {
            if($pr->getName() === $name)
            {
                $exists = true;   
            }
            
        }

        if($exists === FALSE)
        {
            return false;
            die;
        }
        
        $prop = $this->ref_class->getProperty($name);
        $prop->setAccessible(true);
        return $prop->getValue($this->instance); 
    }
    
     public function getValues()
    {
        $props = $this->ref_class->getProperties();        
        $res = [];
        
        foreach ($props as $pr)
        {
            $prop = $this->ref_class->getProperty($pr->getName());
            $prop->setAccessible(true);
            $res[$pr->getName()] = $prop->getValue($this->instance); 
        }

        return $res; 
    }
    

    public function createInstance()
    {
        $this->instance = $this->ref_class->newInstance();
    }
     
    public function setInstance($model)
    {
        $this->instance = $model;
    }


    public function getInstance()
    {
        return $this->instance;
    }
}
