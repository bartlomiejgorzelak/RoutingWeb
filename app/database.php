<?php

use Illuminate\Database\Capsule\Manager as DB;

$capsule = new DB();

$capsule->addConnection([
    'driver'=>'mysql',
    'host'=>'127.0.0.1',
    'username'=>'root',
    'password'=>'root',
    'database'=>'website',
    'charset'=>'utf8',
    'collation'=>'utf8_unicode_ci',
    'prefix'=>'',
    'default' => 'mysql'

]);

$capsule->setAsGlobal();
$capsule->bootEloquent();