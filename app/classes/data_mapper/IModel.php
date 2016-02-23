<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author vasilyevab
 */

namespace app\classes\data_mapper;

interface IModel 
{
    public function setProperty($name, $value);
    public function setProperties($params);
    public function getProperty($name);
    public function getProperties();
    public function exists();
}
