<?php
namespace Modules\Blog;
use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * vokuro-modular
 * Modules.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 22/07/2020
 * Time  : 21:34
 */

class Modules implements ModuleDefinitionInterface
{

    /**
     * @inheritDoc
     */
    public function registerAutoloaders(DiInterface $container = null)
    {
        $loader = new Loader();
        $config = $container->getShared('config');
        $loader->registerNamespaces(
            [
                "Modules\\Blog\\Controllers" => __DIR__."/controllers/",
                "Modules\\Blog\\Models"      => __DIR__."/models/",
            ]
        );

        $loader->register();
    }

    /**
     * @inheritDoc
     */
    public function registerServices(DiInterface $container)
    {
        $config = $container->getShared('config');
        $view = $container->getShared('view');
        $viewsDir = $config->path('application.viewsDir');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setMainView('main');
        $view->setLayoutsDir($viewsDir."layouts/");
        $view->setLayout('public');
    }
}
