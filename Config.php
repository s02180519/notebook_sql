<?php

/*class Config {
    public static $db = [];
}

Config::$db['dsn'] = 'mysql:host=127.0.0.1;dbname=notebook';*/


return array(
    'db' => [
        'dsn' => 'mysql:host=127.0.0.1;dbname=notebook',
        'user name' => 'root',
        'password' => 'test',
        'table name' => 'main_list'
    ]
);

/*function RetDSN(){
    return 'mysql:host=127.0.0.1;dbname=notebook';
}
//$dsn=;
function RetUserName(){
    return 'root';
}
function RetPassword(){
    return 'test';
}

function TableName(){
    return "main_list";
}*/