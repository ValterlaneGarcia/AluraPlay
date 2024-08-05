<?php 
declare(strict_types=1);

namespace Dbseller\AluraPlay\Controller;

use PDO;

class LoginController implements Controller
{
    private PDO $pdo;

    public function __construct()
    {
        $pdo = ConexaoBd::createConnection();
        $this->pdo = $pdo;
    }



    public function processaRequisicao(): void
    {
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

                $sql = 'SELECT * FROM users WHERE email = ?';
                $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
                $statement->execute();

                $userData = $statement->fetch(\PDO::FETCH_ASSOC);
                $correctPassword = password_verify($password, $userData['password'] ?? '');

                if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
                    $stmt = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?;');
                    $stmt->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
                    $stmt->bindValue(2, $userData['id']);
                    $stmt->execute();
                } 

                if ($correctPassword) {
                    $_SESSION['logado'] = true;
            header('Location: /');
        } else {
            header('Location: /login?sucesso=0');
        }
        }
}