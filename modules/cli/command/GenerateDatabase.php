<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 29/12/16
 * Time: 16:22
 */
namespace App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phalcon\Db\Adapter\Pdo\Mysql as DbMysqlAdapter;
use Phalcon\Db\Adapter\Pdo\Postgresql as DbPgsqlAdapter;
use Phalcon\Db\Column;
use Phalcon\Db\Index;

class GenerateDatabase extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:table')
            ->setDescription('Generate Table Database')
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'Database Table name to Generate'
            )
            ->addArgument(
                'column',
                InputArgument::IS_ARRAY,
                'column name (column:type) '
            )
        ;
    }

    public function column_type($type)
    {
        switch ($type){
            case "int"      :
                $result = Column::TYPE_INTEGER;
                break;
            case  "date"    :
                $result = Column::TYPE_DATE;
                break;
            case "varchar"  :
                $result = Column::TYPE_VARCHAR;
                break;
            case "decimal"  :
                $result = Column::TYPE_DECIMAL;
                break;
            case "datetime" :
                $result = Column::TYPE_DATETIME;
                break;
            case "char"     :
                $result = Column::TYPE_CHAR;
                break;
            case "text"     :
                $result = Column::TYPE_TEXT;
                break;
            case "float"    :
                $result = Column::TYPE_FLOAT;
                break;
            case "boolean"  :
                $result = Column::TYPE_BOOLEAN;
                break;
            case "double"   :
                $result = Column::TYPE_DOUBLE;
                break;
            case "tinyblob" :
                $result = Column::TYPE_TINYBLOB;
                break;
            case "blob"     :
                $result = Column::TYPE_BLOB;
                break;
            case "mediumblob" :
                $result = Column::TYPE_MEDIUMBLOB;
                break;
            case "longblob" :
                $result = Column::TYPE_LONGBLOB;
                break;
            case "bigint"   :
                $result = Column::TYPE_BIGINTEGER;
                break;
            case "json"     :
                $result = Column::TYPE_JSON;
                break;
            case "jsonb"    :
                $result = Column::TYPE_JSONB;
                break;
            case "timestamp":
                $result = Column::TYPE_TIMESTAMP;
                break;
            default     :
                $result = Column::TYPE_VARCHAR;
                break;
        }

        return $result;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        define('BASE_PATH',realpath(__DIR__ . '/../../../'));
        define('APP_PATH',BASE_PATH.'/app');
        $config = include APP_PATH."/config/config.php";
        $table  = $input->getArgument('table');
        $column = $input->getArgument('column');

        if($config->database->adapter == 'PgSql'){
            $db = new DbPgsqlAdapter([
                'host'      => $config->database->host,
                'username'  => $config->database->username,
                'password'  => $config->database->password,
                'dbname'    => $config->database->dbname
            ]);
        }else{
            $db = new DbMysqlAdapter([
                'host'      => $config->database->host,
                'username'  => $config->database->username,
                'password'  => $config->database->password,
                'dbname'    => $config->database->dbname
            ]);
        }
        /**
        $map = array();
        $sql = "CREATE TABLE ".$table."( id INTEGER PRIMARY KEY,";
        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            $value  = $entity[2];
            $map[]  = $name.' '.$type.'('.$value.')';
        }
        **/
        /**
        $db->query($sql." ".implode(",",$map).")");
        $db->query("CREATE SEQUENCE ".$table."_id_seq
        START WITH 1
        INCREMENT BY 1
        NO MINVALUE
        NO MAXVALUE
        CACHE 1;");
         * **/
        $arr_column = array(
            new Column("id", array(
                "type"  => Column::TYPE_INTEGER,
                "size"  => 11,
                "notNull"       => true,
                "autoIncrement" => true,
            ))
        );

        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            $value  = $entity[2];
            $arr_column[] = new Column($name, array(
                "type" => $this->column_type($type),
                "size" => $value,
                "notNull" => true,
            ));
        }

        $arr_column[] = new Column("createAt", array(
            "type"    => Column::TYPE_TIMESTAMP,
            "size"    => 17,
            "notNull" => true,
        ));

        try{
            $db->createTable(strtolower($table), null, array(
                "columns" => $arr_column,
                "indexes" => array(
                    new Index("PRIMARY", array("id"))
                )
            ));

            $output->writeln("Created Table $table in Database");
        }catch (Exception $e){
            $output->writeln($e->getMessage("Failed Table $table in Database"));
        }
    }
}