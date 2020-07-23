<?php
use Phalcon\Mvc\Router;
/**
 * vokuro-modular
 * router.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 22/07/2020
 * Time  : 22:12
 */
/**
 * @var $router Router
 */
$router->add('/blog', array(
    'namespace'  => 'Modules\Blog\Controllers',
    'module'     => 'blog',
    'controller' => 'blog',
    'action'     => 'index'
));
