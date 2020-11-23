<?php

namespace IA\Http\Routes;

$collection = new RouteCollection();

/**
 * Main page
 */
$collection->add('create', array(
    'pattern'           => 'index',
    'controller'        => 'home',
    'method'            => 'create'
));
