<?php

namespace app\services;

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

class MigrationService
{
    /**
     * @var use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter
     */
    protected $db;

    public function __construct(DbAdapter $db)
    {
        $this->db = $db;
    }

    /**
     * Creates basic database tables layout, based on SQL file located at: db/bandmanager.sql
     * 
     * @throws Exception
     */
    public function init()
    {
        try {
            $path = APP_ROOT . '/db/bandmanager.sql';
            $sql = file_get_contents($path);

            $this->db->execute($sql);

        } catch (\Exception $e) {
            echo 'Error occured: ' . $e->getMessage();
            return;
        }

        echo 'Initial database tables are successfully created.';
    }
}
