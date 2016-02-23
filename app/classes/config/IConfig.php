<?php

namespace app\classes\config;

interface IConfig
{
    public function set_path($config_path);
    public function set($config);
    public function get();
    public function update($config);
}