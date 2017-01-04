<?php

/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 29/12/16
 * Time: 11:13
 */
namespace App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateModel extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:model')
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
        $names      = $input->getArgument('table');
        $column     = $input->getArgument('column');

        $map ="";
        $directory  = '../../modules';
        $model_dir = $directory."/".strtolower($module)."/models";
        if(! mkdir($model_dir,0755, true)){
            $output->writeln("Failed to create model Directory");
        }
        $file = file_get_contents($directory."/cli/src/model.txt");
        $file = str_replace("!module", ucfirst($module), $file);
        $file = str_replace("!name", ucfirst($names), $file);
        $file = str_replace("?name", strtolower($names), $file);
        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            $value  = $entity[2];
            $map    .= '/**'."\n";
            $map    .= "\t".'*'."\n";
            $map    .= "\t".'* @var '.$type."\n";
            $map    .= "\t".'* @Column(type="'.$type.'", length=10, nullable=false)'."\n";
            $map    .= "\t".'*/'."\n";
            $map    .= "\t".''."\n";
            $map    .= "\t".'public $'.$name.';'."\n";
        }
        $file = str_replace("!column", $map, $file);
        if (!file_exists($model_dir."/".ucfirst($names).".php")) {
            $fh = fopen($model_dir."/".ucfirst($names). ".php", "w");
            fwrite($fh, $file);
            fclose($fh);

            $className = ucfirst($names) . ".php";

            $output->writeln("Created $className Model in modules");
        } else {
            $output->writeln("Class modules already Exists!");
        }

    }
}