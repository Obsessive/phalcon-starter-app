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

        echo 'Initial database tables are successfully created.' . PHP_EOL;
    }

    /**
     * Runs all the migrations that haven't been run yet.
     */
    public function migrate()
    {
        $latestMigration = $this->findLatest();
        $nextMigration = $latestMigration + 1;

        while ($this->migrationExists($nextMigration)) {
            $this->runMigration($nextMigration);
            $nextMigration++;
        }

        if ($nextMigration - 1 == $latestMigration)
            printf('There are no new migrations.' . PHP_EOL);
    }

    /**
     * Returns the number of the latest migration or -1 on error (presumably no
     * migrations have been run yet).
     *
     * @return integer
     */
    public function findLatest()
    {
        $sql = 'SELECT MAX(num) FROM migrations';

        try {
            $num = $this->db->fetchColumn($sql);
            return intval($num);

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }


    /**
     * @param integer $num
     * @return boolean
     */
    private function migrationExists($num)
    {
        return file_exists($this->migrationPath($num));
    }

    /**
     * @param integer $num
     * @throws Exception
     */
    private function runMigration($num)
    {
        $path = $this->migrationPath($num);
        $sql = file_get_contents($path);

        if ($sql === false)
            throw new RuntimeException('Read error: ' . $path);

        if ( $this->db->execute($sql) ) {
            echo "[OK] " . $num . ".sql".PHP_EOL;
        }
        else {
            throw new RuntimeException('Error running migration: '.$num.'.sql');
        }
    }

    /**
     * @param integer $num
     * @return string
     */
    private function migrationPath($num)
    {
        return APP_ROOT . '/db/migrations/' . intval($num) . '.sql';
    }
}
