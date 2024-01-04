<?php

namespace database;

use Albert\PruebaTecnicaPhpAlberto\config\Database1;
use SQLite3;

class Sqlite extends SQLite3
{
    //const PATH_TO_SQLITE_FILE = 'sqlite.db';
    public function __construct($file)
    {
        try {
            parent::__construct($file);
        }
        catch (\Throwable $throwable)
        {
            throw $throwable;
        }

    }

}