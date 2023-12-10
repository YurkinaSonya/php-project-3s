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
        $this->createDbTables();
        $this->createDbData();
        $this->createDbTriggers();
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
        }
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
        }
    }

    private function createDbData() : void
    {
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 0';
        $this->db->execute($fkSql);
        foreach (DbDataSeeder::getData() as $tableName => $data) {
            foreach ($data as $item) {
                $this->db->insert($tableName, $item);
            }
        }
        $fkSql = 'SET FOREIGN_KEY_CHECKS = 1';
        $this->db->execute($fkSql);
    }
}