<?php

namespace database;

use SQLite3;

class DatabaseSqlite implements IDatabase
{
    private $db;

    const PATH_TO_SQLITE_FILE = 'sqlite.db';

    public function __construct()
    {
        $this->db = new SQLite3(self::PATH_TO_SQLITE_FILE) or die('Unable to open database');
        $this->db->enableExceptions(true);
    }

    /**
     * Load connection database
     * @return void
     */
    public function connection()
    {
        echo 'connection String'; //Sqlite don't have
    }

    public function exec($sql)
    {
      //  $this->db->open(Sqlite::PATH_TO_SQLITE_FILE);
        $this->db = new SQLite3(self::PATH_TO_SQLITE_FILE) or die('Unable to open database');
        $this->db->exec($sql);
        $this->db->close();
    }

    public function query($sql)
    {
        $this->db = new SQLite3(self::PATH_TO_SQLITE_FILE) or die('Unable to open database');
        $result = $this->db->query($sql);
        $this->db->close();
        return $result;
    }

    public function querySingle($sql)
    {
        $this->db = new SQLite3(self::PATH_TO_SQLITE_FILE) or die('Unable to open database');
        $result = $this->db->querySingle($sql, true);
        $this->db->close();
        return $result;
    }
}

