<?php

use Illuminate\Database\Capsule\Manager as DB;

$capsule = new DB();

$capsule->addConnection([
    'driver'=>'mysql',
    'host'=>'remotemysql.com:3306',
    'username'=>'z8zEdHoV56',
    'password'=>'RWiJmIE68g',
    'database'=>'z8zEdHoV56',
    'charset'=>'utf8',
    'collation'=>'utf8_unicode_ci',
    'prefix'=>'',
    'default' => 'mysql'

]);

$capsule->setAsGlobal();
$capsule->bootEloquent();