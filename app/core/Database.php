<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dsn = "pgsql:host=" . DB_HOST . ";port=5432;dbname=" . DB_NAME;

        $this->pdo = new PDO(
            $dsn,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
