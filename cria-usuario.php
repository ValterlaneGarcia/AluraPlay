<?php 

declare(strict_types=1);
require_once 'vendor/autoload.php';

use Dbseller\AluraPlay\Controller\ConexaoBd;

$pdo = ConexaoBd::createConnection();

$email = $argv[1];
$password = $argv[2];

$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?,?);';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $email);
$stmt->bindValue(2, $hash);
$stmt->execute();