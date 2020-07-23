<?php
declare(strict_types=1);

/**
 * This file is part of the Vökuró.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Vokuro;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Application as MvcApplication;
use Phalcon\Text;

/**
 * Vökuró Application
 */
class Application
{
    const APPLICATION_PROVIDER = 'bootstrap';

    /**
     * @var MvcApplication
     */
    protected $app;

    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * Project root path
     *
     * @var string
     */
    protected $rootPath;

    /**
     * @param string $rootPath
     *
     * @throws Exception
     */
    public function __construct(string $rootPath)
    {
        $this->di = new FactoryDefault();
        $this->app = $this->createApplication();
        $this->rootPath = $rootPath;
        $this->app->registerModules($this->modulesInit());

        $this->di->setShared(self::APPLICATION_PROVIDER, $this);

        $this->initializeProviders();
    }

    /**
     * Run Vökuró Application
     *
     * @return string
     * @throws Exception
     */
    public function run(): string
    {
        $baseUri = $this->di->getShared('url')->getBaseUri();
        $position = strpos($_SERVER['REQUEST_URI'], $baseUri) + strlen($baseUri);
        $uri = '/' . substr($_SERVER['REQUEST_URI'], $position);

        /** @var ResponseInterface $response */
        $response = $this->app->handle($uri);

        return (string)$response->getContent();
    }

    /**
     * Get Project root path
     *
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }

    /**
     * @return MvcApplication
     */
    protected function createApplication(): MvcApplication
    {
        return new MvcApplication($this->di);
    }

    /**
     * @throws Exception
     */
    protected function initializeProviders(): void
    {
        $filename = $this->rootPath . '/config/providers.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception('File providers.php does not exist or is not readable.');
        }

        $providers = include_once $filename;
        foreach ($providers as $providerClass) {
            /** @var ServiceProviderInterface $provider */
            $provider = new $providerClass;
            $provider->register($this->di);
        }
    }

    private function modulesInit()
    {
        $filename = $this->rootPath . '/config/modules.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception('File modules.php does not exist or is not readable.');
        }
        $modules_name = include_once $filename;
        $modules = array();
        if(!empty($modules_name)){
            foreach ($modules_name as $module) {
                $simple = Text::uncamelize($module);
                $simple = str_replace('_', '-', $simple);
                $modules[$simple] = array(
                    'namespace' => 'Modules\\'.ucfirst($module),
                    'className' => 'Modules\\'.ucfirst($module) . '\Modules',
                    'path' => $this->rootPath . '/modules/' . $module . '/Modules.php'
                );
            }
        }
        return $modules;
    }
}
