<?php 
namespace Dbseller\AluraPlay\Controller;

use PDO;
use PDOException;

class ConexaoBd
{
    public static function createConnection(): PDO
    {
        $host = 'localhost';
        $dbname = 'aluraplay';
        $username = 'dbseller';
        $password = 'halegria';
        $port = '5432'; 

        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;options='--client_encoding=UTF8'";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
}