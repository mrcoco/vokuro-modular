<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
$router = new Phalcon\Mvc\Router();

$router->removeExtraSlashes(true);

$router->add('/confirm/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'confirmEmail'
]);

$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);

$modules = include APP_PATH . '/config/modules.php';
foreach ($modules as $module){
    if(file_exists(BASE_PATH . '/modules/'.$module.'/router.php')){
        require_once BASE_PATH . '/modules/'.$module.'/router.php';
    }
}


return $router;
