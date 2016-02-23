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
 * Description of temes_mapper
 *
 * @author User
 */
class temes_mapper extends data_mapper\mapper
{
    public function getTemes()
    {
        $this->query_builder->select(['*'])->from(['temes']);
        $this->prepare([]);
        return $this->get(models\temes_model::create());
    }
    
    public function getTemeById($id)
    {
        $this->query_builder->select(['*'])->from(['temes'])->where([['id = ' => ':id']]);
        $this->prepare([':id' => $id]);
        return $this->get(models\temes_model::create());
    }
    
    public function getTemesBySectionId($id)
    {
        $this->query_builder->select(['*'])->from(['temes'])->where([['sectionid = ' => ':sectionid']]);
        $this->prepare([':sectionid' => $id]);
        return $this->get(models\temes_model::create());
    }
    
    public function getCountTemesBySectionId($id)
    {
        $this->query_builder->select(['Count(*) as count'])->from(['temes'])->where([['sectionid = ' => ':sectionid']]);
        $this->prepare([':sectionid' => $id]);
        
        return $this->get(models\temes_model::create());
    }
    
    public function getLastTemeBySectonid($id)
    {
        $this->query_builder->select(['*'])->from(['temes'])->
                where([['sectionid = ' => ':sectionid']])->
                order_by('createdate', 'desc')->limit('1');
        $this->prepare([':sectionid' => $id]);
        return $this->get(models\temes_model::create());
    }
    
    public function addTeme(data_mapper\IModel $teme)
    {
        //var_dump($user);
        if($teme->exists())
        {
            $this->query_builder->update('temes')->set([
                ['name=' => ':name'], ['sectionid =' => ':sectionid'], ['createdate =' => ':createdate']              
                ])->where([['id =' => ':id']]);
            
            $this->set([
                ':id' => $teme->getProperty('id'),
                ':name' => $teme->getProperty('name'),
                ':sectionid' => $teme->getProperty('sectionid'),
                ':createdate' => $teme->getProperty('createdate')
                 ]);
        }
        else 
        {
            $this->query_builder->insert('temes', ['name', 'sectionid', 'createdate'])->values([':name', ':sectionid', ':createdate']);
            $this->set([':name' => $teme->getProperty('name'), 
                ':sectionid' => $teme->getProperty('sectionid'), 
                ':createdate' => $teme->getProperty('createdate')]);
        }
       
    }
}
