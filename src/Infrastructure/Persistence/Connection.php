<?php

namespace Crud\Infrastructure\Persistence;

use Exception;
use PDO;
use PDOException;

class Connection

{
    /**
     * @throws Exception
     */
    public static function createConnection(): PDO
    {
        try {
            // Se chegou aqui, a conexão foi criada com sucesso.
            return new PDO(
                'mysql:host=localhost;dbname=crud_restaurante;charset=utf8mb4;port=3306',
                'root',
                '05091721',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa exceções em caso de erro
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // retorna como array associativo
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }
}


