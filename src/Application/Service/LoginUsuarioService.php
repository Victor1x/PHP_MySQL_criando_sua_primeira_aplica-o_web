<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\LoginUsuarioDTO;
use Crud\Domain\Repository\UsuarioRepositoryInterface;

use InvalidArgumentException;

class LoginUsuarioService
{
    private UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(UsuarioRepositoryInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function executar(LoginUsuarioDTO $dto): void
    {

        $usuarioExistente = $this->usuarioRepository->buscarPorUsuario($dto->getEmail());

        if (!$usuarioExistente) {
            throw new InvalidArgumentException('O usuário não possui cadastro no sistema.');
        }

        var_dump(password_verify($dto->getSenha(),$usuarioExistente->getSenha()->getHash()));

        if (!$usuarioExistente->getSenha()->verify($dto->getSenha())) {
            throw new InvalidArgumentException('Senha inválida.');
        }


    }
}