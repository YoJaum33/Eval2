<?php

const DB_HOST    = "localhost";
const DB_NAME    = "cameron";
const DB_LOGIN   = "base2";
const DB_PASS    = "Ecrouves!54";

    const DB_DRIVER  = "mysql";
    const DB_CHARSET = "utf8mb4";

    const DB_OPTIONS = [
    PDO::ATTR_EMULATE_PREPARES   => false, 
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::MYSQL_ATTR_FOUND_ROWS   => true 
    ];

?>