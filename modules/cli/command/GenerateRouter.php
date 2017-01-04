<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 02/01/17
 * Time: 16:04
 */

namespace App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRouter extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:router')
            ->setDescription('Generate Model Class')
            ->addArgument(
                'module',
                InputArgument::REQUIRED,
                'Module name to Generate'
            )
            ->addArgument(
                'controller',
                InputArgument::REQUIRED,
                'Controller name to Generate'
            )
            ->addArgument(
                'action',
                InputArgument::REQUIRED,
                'Action name To Generate '
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $module     = $input->getArgument('module');
        $controller = $input->getArgument('controller');
        $action     = $input->getArgument('action');
        $directory  = '../../modules';
        //============== create index view ================//
        $route = $directory."/".strtolower($module);

        $file = file_get_contents($directory."/cli/src/router.txt");
        $file = str_replace("!module", ucfirst($module), $file);
        $file = str_replace("!date",date('d/m/Y'),$file);
        $file = str_replace("!time",date('HH:mm:ss'),$file);
        if (!file_exists($route."/router.php")) {
            $fh = fopen($route."/router.php", "w");
            fwrite($fh, $file);
            fclose($fh);

            $className = "router.php";

            $output->writeln("Created $className in modules ".$module);
        } else {
            $_file = file_get_contents($directory."/cli/src/add_router.txt");
            $_file = str_replace("!module", ucfirst($module), $_file);
            $_file = str_replace("?action", ucfirst($action), $_file);
            $_file = str_replace("!date",date('d/m/Y'),$_file);
            $_file = str_replace("!time",date('H:m:s'),$_file);
            $fh = fopen($route."/router.php", "w");
            fwrite($fh, $_file);
            fclose($fh);

            $className = "router.php";
            $output->writeln("Created $className in modules ".$module);
        }

    }
}