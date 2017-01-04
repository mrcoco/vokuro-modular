<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 30/12/16
 * Time: 11:20
 */

namespace App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateController extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:controller')
            ->setDescription('Generate Model Class')
            ->addArgument(
                'module',
                InputArgument::REQUIRED,
                'Module name to Generate'
            )
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'Model name to Generate'
            )
            ->addArgument(
                'column',
                InputArgument::IS_ARRAY,
                'column name (column:type) '
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $module     = $input->getArgument('module');
        $table      = $input->getArgument('table');
        $column     = $input->getArgument('column');
        $directory  = '../../modules';
        //============ create controller=============
        $controler  = $directory."/".strtolower($module)."/controller";
        if(! mkdir($controler,0755, true)){
            $output->writeln("Failed to create model Directory");
        }
        $map ="";
        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];   // column name
            $type   = $entity[1];   // column type
            $value  = $entity[2];   // column value
            $map    .= "\t"."'".$name."' => $"."item->".$name.";"."\n\t";
        }
        $file = file_get_contents($directory."/cli/src/controller.txt");
        $file = str_replace("!module", ucfirst($module), $file);
        $file = str_replace("!column", ucfirst($map), $file);
        $file = str_replace("!model", ucfirst($table), $file);
        $file = str_replace("!date",date('d/m/Y'),$file);
        $file = str_replace("!time",date('H:m:s'),$file);
        if (!file_exists($controler."/".ucfirst($table)."Controller.php")) {
            $fh = fopen($controler."/".ucfirst($table). "Controller.php", "w");
            fwrite($fh, $file);
            fclose($fh);

            $className = ucfirst($table) . ".php";

            $output->writeln("Created $className Controller in modules");
        } else {
            $output->writeln("Class modules already Exists!");
        }
    }

}