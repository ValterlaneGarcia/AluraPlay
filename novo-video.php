<?php
    require_once 'vendor/autoload.php';

    use Dbseller\AluraPlay\Infra\Persistence\ConexaoBd;
    $pdo = ConexaoBd::createConnection();
    
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if ($url === false) {
      header('Location: /?sucesso=0');
        exit();
    }
    $titulo = filter_input(INPUT_POST, 'titulo');
    
    $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $url);
    $statement->bindValue(2, $titulo);
    
    if ($statement->execute() === false) {
        header('Location: /?sucesso=0');
    } else {
        header('Location: /?sucesso=1');
    }