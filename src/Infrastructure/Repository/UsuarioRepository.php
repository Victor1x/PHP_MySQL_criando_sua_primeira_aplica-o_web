<?php
namespace Crud\Infrastructure\Repository;

use Crud\Domain\Entity\Usuario;
use Crud\Domain\Repository\UsuarioRepositoryInterface;
use Crud\Domain\ValueObject\Email;
use Crud\Domain\ValueObject\Name;
use Crud\Domain\ValueObject\Senha;

use PDO;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
public function salvar(Usuario $usuario): void
{
    $sql = "INSERT INTO usuarios (nome, email, hash) VALUES (:nome, :email, :hash)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $usuario->getNome(),
        ':email' => $usuario->getEmail(),
        ':hash' => $usuario->getSenha()->getHash()
    ]);
}

public function buscarPorUsuario(string $usuario): ?Usuario
{
    $sql = "SELECT * FROM usuarios WHERE email = :usuario";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $dados = $stmt->fetch();

    if (!$dados) {
        return null;
    }
//var_dump($dados);
    return new Usuario(
        (int)$dados['id'],
        new Name( $dados['nome']) ,
        new Email($dados['email']),
        Senha::fromHash($dados['hash'])
    );
}


}