<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author User
 */

//namespace bin\models;


namespace bin\models;
use app\classes\data_mapper;

class user_model extends data_mapper\model implements data_mapper\IModel
{
    protected $model_name = 'bin\\models\\user_model';
    protected $id = 0;
    protected $name = 0;
    protected $login = 0;
    protected $password = 0;
    protected $email = 0;
    protected $role = 0;
}
