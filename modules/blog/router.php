<?php
/**
 * Created by Vokuro-Cli
 * User: dwiagus
 * Date: 10/01/2017
 * Time: 0909:0101:2727
 */

$router->add('/blog', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'index'
));

$router->add('/blog/list', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'list'
));

$router->add('/blog/create', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'create'
));

$router->add('/blog/edit', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'edit'
));

$router->add('/blog/delete', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'delete'
));

