<?php

require_once 'vendor/autoload.php';

use Dbseller\AluraPlay\Infra\Persistence\ConexaoBd;

$pdo = ConexaoBd::createConnection();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: /listagem-cursos.php?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /listagem-cursos.php?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /listagem-cursos.php?sucesso=0');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

if ($statement->execute() === false) {
    header('Location: /listagem-cursos.php?sucesso=0');
} else {
    header('Location: /listagem-cursos.php?sucesso=1');
}