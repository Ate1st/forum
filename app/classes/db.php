<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.07.2015
 * Time: 19:48
 */

namespace app\classes;

use app\classes\config;

class db
{
    private static $pdo = null;
    private static $state = 0;

    public static function Connect(config\config $config)
    {
        if(self::$pdo)
        {
            return true;
        }
        
        $dsn = 'mysql:dbname='.$config->get('db_config')['db_name'].';host='.$config->get('db_config')['db_host'].';';
        self::$state = $config->get('db_config')['connect'];
        
        if((int)self::$state === 1)
        {
            self::$pdo = new \PDO($dsn, $config->get('db_config')['db_user'], $config->get('db_config')['db_password']);
            self::$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false); 
            return true;
        }
        else 
        {
            return false;
        }
    }
    
    public static function getPDO()
    {
        return self::$pdo;
    }
    
    

}