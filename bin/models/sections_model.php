<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bin\models;
use app\classes\data_mapper;
/**
 * Description of sections_model
 *
 * @author User
 */
class sections_model extends data_mapper\model implements data_mapper\IModel
{
    protected $model_name = 'bin\\models\\sections_model';
    protected $id = 0;
    protected $name = 0;
    protected $description = 0;
}
