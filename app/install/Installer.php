<?php

namespace app\install;

use core\db\Handler;

class Installer
{
    private Handler $db;

    /**
     * @param Handler $db
     */
    public function __construct(Handler $db)
    {
        $this->db = $db;
    }


    public function install() :void
    {
        echo 'installing started' . PHP_EOL;
        echo 'creating tables ';
        $this->createDbTables();
        echo 'tables created' . PHP_EOL;
        echo 'filling in data ' . PHP_EOL;
        $this->createDbData();
        echo 'filling in data finished' . PHP_EOL;
        echo 'creating triggers ';
        $this->createDbTriggers();
        echo 'triggers created' . PHP_EOL;
        echo 'installing finished' . PHP_EOL;
    }

    private function createDbTables() : void
    {
        $requests = DbTablesSeeder::getQueries();
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 0';
        $this->db->execute($fkSql);
        foreach ($requests as $tableName => $sql) {
            $dropSql = 'DROP TABLE if EXISTS `' . $tableName . '`';
            $this->db->execute($dropSql);
            $this->db->execute($sql);
            echo '.';
        }
        echo PHP_EOL;
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 1';
        $this->db->execute($fkSql);
    }

    private function createDbTriggers() : void
    {
        $requests = DbTriggerSeeder::getQueries();
        foreach ($requests as $triggerName => $sql) {
            $dropSql = 'DROP TRIGGER if EXISTS `' . $triggerName . '`';
            $this->db->execute($dropSql);
            $this->db->execute($sql);
            echo '.';
        }
        echo PHP_EOL;
    }

    private function createDbData() : void
    {
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 0';
        $this->db->execute($fkSql);
        foreach (DbDataSeeder::getData() as $tableName => $data) {
            echo 'filling table ' . $tableName . '  ';
            foreach ($data as $item) {
                $this->db->insert($tableName, $item);
                echo '.';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 1';
        $this->db->execute($fkSql);
    }
}