#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 29/12/16
 * Time: 11:03
 */

use Symfony\Component\Console\Application;
use App\Commands\GenerateModel;
use APP\Commands\GenerateDatabase;
use App\Commands\GenerateModule;
use App\Commands\GenerateController;
use App\Commands\GenerateRouter;
use App\Commands\GenerateView;

require '../../vendor/autoload.php';

foreach (glob(__DIR__."/command/*.php") as $filename)
{
    include $filename;
}

$application = new Application();
$application->add(new GenerateModule());
$application->add(new GenerateModel());
$application->add(new GenerateDatabase());
$application->add(new GenerateController());
$application->add(new GenerateView());
$application->add(new GenerateRouter());
try {

    $application->run();

} catch(\Exception $e) {

    echo $e->getMessage();
    exit(255);
}
