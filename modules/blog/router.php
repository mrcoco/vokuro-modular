<?php
$router->add('/blog', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'index'
));

$router->add('/blog/test', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'test'
));

