<?php

namespace Crud\Infrastructure\Persistence;

use PDO;

class Connection
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            self::$connection = new PDO(
                'mysql:host=localhost;dbname=crud_restaurante',
                'root',
                '05091721',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            );
        }

        return self::$connection;
    }
}


