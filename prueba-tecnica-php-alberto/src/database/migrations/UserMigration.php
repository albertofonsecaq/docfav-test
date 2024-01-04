<?php

namespace database\migrations;

use database\Database;
use database\DatabaseSqlite;

class UserMigration
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseSqlite();
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                        id  INTEGER PRIMARY KEY,
                        email TEXT NOT NULL,
                        name TEXT,
                        password TEXT NOT NULL,
                        CONSTRAINT email_unique UNIQUE (email)
                    )";
        $this->db->exec($sql);

    }

}