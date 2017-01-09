<?php
/**
 * Created by Vokuro-Cli
 * User: dwiagus
 * Date: 09/01/2017
 * Time: 0808:0101:4848
 */

$router->add('/page', array(
    'namespace'  => 'Modules\Page\Controllers',
    'module'     => 'page',
    'controller' => 'page',
    'action'     => 'index'
));

$router->add('/page/list', array(
    'namespace'  => 'Modules\Page\Controllers',
    'module'     => 'page',
    'controller' => 'page',
    'action'     => 'list'
));

$router->add('/page/create', array(
    'namespace'  => 'Modules\Page\Controllers',
    'module'     => 'page',
    'controller' => 'page',
    'action'     => 'create'
));

$router->add('/page/edit', array(
    'namespace'  => 'Modules\Page\Controllers',
    'module'     => 'page',
    'controller' => 'page',
    'action'     => 'edit'
));

$router->add('/page/delete', array(
    'namespace'  => 'Modules\Page\Controllers',
    'module'     => 'page',
    'controller' => 'page',
    'action'     => 'delete'
));

