<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author User
 */

namespace app\classes\controller;

use app\classes\request;

interface IController 
{
    public function call(request\IRequest $request, $params = []);
}
