<?php

namespace app\classes\request;

interface IRequest
{
    public function  init($config);
    public function  getRoute();
}