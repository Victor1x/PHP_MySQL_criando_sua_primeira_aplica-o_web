<?php
namespace Crud\Application\Service;                        // Define o namespace da classe

use Crud\Application\DTO\LoginUsuarioDTO;               // Importa o DTO de login
use Crud\Domain\Repository\UsuarioRepositoryInterface; // Importa a interface do repositório de usuários
use Crud\Domain\Entity\Usuario;                        // Importa a entidade Usuário
use InvalidArgumentException;                          // Importa a exceção de argumento inválido

class LoginUsuarioService
{
    // Recebe uma instância do repositório de usuário via injeção de dependência
    public function __construct(private UsuarioRepositoryInterface $usuarioRepository) {}

    /**
     * Tenta autenticar o usuário e retorna a entidade Usuário em caso de sucesso
     * @throws InvalidArgumentException em caso de credenciais inválidas
     */
    public function executar(LoginUsuarioDTO $dto): Usuario
    {
        $mensagemErro = 'E-mail ou senha inválidos.'; // Mensagem genérica para não vazar informação

        // Tenta buscar o usuário no banco pelo e-mail
        $usuario = $this->usuarioRepository->buscarPorUsuario($dto->getEmail());

        // Se não encontrou usuário ou a senha não bate, lança exceção
        if (!$usuario || !$usuario->getSenha()->verify($dto->getSenha())) {
            throw new InvalidArgumentException($mensagemErro);
        }

        // Se chegou aqui, as credenciais estão corretas: retorna o objeto Usuário
        return $usuario;
    }
}
