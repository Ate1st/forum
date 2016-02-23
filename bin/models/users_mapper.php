<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users_mapper
 *
 * @author User
 */

namespace bin\models;

use app\classes\data_mapper;
use bin\models;



class users_mapper extends data_mapper\mapper
{
    public function getUsers()
    {
        $this->query_builder->select(['*'])->from(['users']);
        $this->prepare([]);
        return $this->get(models\user_model::create());
    }
    
    public function getUserById($id)
    {
        $this->query_builder->select(['*'])->from(['users'])->where([['id = ' => ':id']]);
        $this->prepare([':id' => $id]);
        return $this->get(models\user_model::create());
    }
    
    public function getUserByName($name)
    {
        $this->query_builder->select(['*'])->from(['users'])->where([['name = ' => ':name']]);
        $this->prepare([':name' => $name]);
        return $this->get(models\user_model::create());
    }
    
    public function addUser(data_mapper\IModel $user)
    {
        //var_dump($user);
        if($user->exists())
        {
            $this->query_builder->update('users')->set([
                ['name=' => ':name'],
                ['password=' => ':password'],
                ['email=' => ':email']
                ])->where([['id =' => ':id']]);
            
            $this->set([
                ':id' => $user->getProperty('id'),
                ':name' => $user->getProperty('name'),
                ':password' => $user->getProperty('password'),
                ':email' => $user->getProperty('email')
                 ]);
        }
        else 
        {
            $this->query_builder->insert('users', ['name', 'password', 'email'])->values([
                ':name', ':password', ':email'
            ]);
            $this->set([':name' => $user->getProperty('name'), 
                ':password' => $user->getProperty('password'), 
                ':email' => $user->getProperty('email')]);
        }
       
    }
}
