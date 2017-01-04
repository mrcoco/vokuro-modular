<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 29/12/16
 * Time: 20:57
 */

namespace App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

class GenerateModule extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:module')
            ->setDescription('Generate Module')
            ->addArgument(
                'module',
                InputArgument::REQUIRED,
                'Module name to Generate'
            )
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'DataBase Table name to Generate'
            )
            ->addArgument(
                'column',
                InputArgument::IS_ARRAY,
                'column name (column:type:value) '
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names  = $input->getArgument('module');
        $table  = $input->getArgument('table');
        $column = $input->getArgument('column');
        $module = "../../modules";
        if (is_dir($module) && !is_writable($module)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }
        if(is_dir($module)){
            if(mkdir($module."/".strtolower($names),0755, true)){
                //========== Generate Module config =========
                $file = file_get_contents($module."/cli/src/module.txt");
                $file = str_replace("!module", ucfirst($names), $file);
                $file = str_replace("!date",date('d/m/Y'),$file);
                $file = str_replace("!time",date('HH:mm:ss'),$file);
                if (!file_exists($module."/".$names."/Modules.php")) {
                    $fh = fopen($module."/".$names."/Modules.php", "w");
                    fwrite($fh, $file);
                    fclose($fh);

                    $className = ucfirst($names) . ".php";

                    $output->writeln("Created config $className in modules");
                } else {
                    $output->writeln("Class modules already Exists!");
                }

                //
                //========== Generate Database ==============
                $databse = $this->getApplication()->find('create:table');
                $databse_arguments = array(
                    'command'   => 'create:table',
                    'table'     => $input->getArgument('table'),
                    'column'    => $input->getArgument('column')
                );
                $input_db   = new ArrayInput($databse_arguments);
                $return_db  = $databse->run($input_db,$output);
                $output->writeln($return_db);

                //
                //============ Generate Model =============
                $model = $this->getApplication()->find('create:model');
                $model_arguments = array(
                    'command'   => 'create:model',
                    'module'    => $input->getArgument('module'),
                    'table'     => $input->getArgument('table'),
                    'column'    => $input->getArgument('column')
                );

                $input_model = new ArrayInput($model_arguments);
                $return_model= $model->run($input_model,$output);
                $output->writeln($return_model);

                //
                //============ Generate Controller ========
                $controller = $this->getApplication()->find('create:controller');
                $controller_arguments = array(
                    'command'   => 'create:model',
                    'module'    => $input->getArgument('module'),
                    'table'     => $input->getArgument('table'),
                    'column'    => $input->getArgument('column')
                );
                $input_controller   = new ArrayInput($controller_arguments);
                $return_controller  = $controller->run($input_controller,$output);
                $output->writeln($return_controller);

                //
                //============ Generate Route =============
                $router = $this->getApplication()->find('create:router');
                $router_arguments = array(
                    'command'       => 'create:router',
                    'module'        => $input->getArgument('module'),
                    'contorller'    => $input->getArgument('table'),
                    'action'        => 'index'
                );
                $input_router = new ArrayInput($router_arguments);
                $return_router = $router->run($input_router,$output);
                $output->writeln($return_router);
            }else{
                $output->writeln("Failed create Module");
            }
        }else{
            $output->writeln("Directory Module not Exsist");
        }
    }
}