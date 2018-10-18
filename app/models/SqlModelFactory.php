<?php
/**
 * Created by PhpStorm.
 * User: piotr.grzegorzewski
 * Date: 14/10/2018
 * Time: 08:50
 */

namespace models;

use DB\SQL;
use Symfony\Component\Yaml\Yaml;

class SqlModelFactory extends \Prefab
{
    /** @var \Base */
    private $f3;
    /** @var SQL */
    private $db;

    public function __construct()
    {
        $this->f3 = \Base::instance();
        $dbConfig = Yaml::parseFile("config.yaml")['db'];
        $this->db = new SQL(
            sprintf(
                "mysql:host=%s;port=%s;dbname=%s",
                $dbConfig['host'],
                $dbConfig['port'],
                $dbConfig['database']
            ),
            $dbConfig['user'],
            $dbConfig['password']
        );
    }

    /**
     * @param string $tableName
     * @return SQL\Mapper
     */
    public function getMapper($tableName)
    {
        return new SQL\Mapper($this->db, $tableName);
    }
}