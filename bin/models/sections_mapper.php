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
 * Description of sections_mapper
 *
 * @author User
 */
class sections_mapper extends data_mapper\mapper
{
    public function getSections()
    {
        $this->query_builder->select(['*'])->from(['sections']);
        $this->prepare([]);
        return $this->get(models\sections_model::create());
    }
    
    public function getSectionById($id)
    {
        $this->query_builder->select(['*'])->from(['sections'])->where([['id =' => ':id']]);
        $this->prepare([':id' => $id]);
        return $this->get(models\sections_model::create());
    }
    
    public function getSectionByName($name)
    {
        $this->query_builder->select(['*'])->from(['sections'])->where([['name =' => ':name']]);
        $this->prepare([':name' => $name]);
        return $this->get(models\sections_model::create());
    }
    
    public function addSection(data_mapper\IModel $section)
    {
        //var_dump($user);
        if($section->exists())
        {
            $this->query_builder->update('sections')->set([
                ['name=' => ':name']              
                ])->where([['id =' => ':id']]);
            
            $this->set([
                ':id' => $section->getProperty('id'),
                ':name' => $section->getProperty('name')                
                 ]);
        }
        else 
        {
            $this->query_builder->insert('sections', ['name'])->values([':name']);
            $this->set([':name' => $section->getProperty('name')]);
        }
       
    }
}
