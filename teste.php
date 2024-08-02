<?php

use Dbseller\AluraPlay\Controller\ConexaoBd;

require_once 'vendor/autoload.php';




try {
    // Tenta criar a conexão com o banco de dados
    $pdo = ConexaoBd::createConnection();

    if ($pdo) {
        echo "Conexão bem-sucedida!\n";

        // Executa uma consulta básica para testar a conexão
        $sql = "SELECT * FROM videos LIMIT 1";
        $stmt = $pdo->query($sql);
        
        // Verifica se há resultados
        if ($stmt) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resultado)) {
                echo "Consulta bem-sucedida! Resultado:\n";
                print_r($resultado);
            } else {
                echo "Nenhum dado encontrado na tabela.\n";
            }
        } else {
            echo "Erro ao executar a consulta.\n";
        }
    } else {
        echo "Erro ao criar a conexão.\n";
    }
} catch (PDOException $e) {
    echo "Erro durante a execução: " . $e->getMessage();
}
?>