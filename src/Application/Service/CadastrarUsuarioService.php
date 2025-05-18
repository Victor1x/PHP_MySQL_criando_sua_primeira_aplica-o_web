<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\CadastrarUsuarioDTO;
use Crud\Domain\Entity\Usuario;
use Crud\Domain\Repository\UsuarioRepositoryInterface;
use Crud\Domain\ValueObject\Email;
use Crud\Domain\ValueObject\Name;
use Crud\Domain\ValueObject\Senha;
use InvalidArgumentException;

class CadastrarUsuarioService
{
    private UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(UsuarioRepositoryInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function executar(CadastrarUsuarioDTO $dto): void
    {

        $usuarioExistente = $this->usuarioRepository->buscarPorUsuario($dto->getEmail());

        if ($usuarioExistente) {
            throw new InvalidArgumentException('Já existe um usuário com este email.');
        }

        $usuario = new Usuario(
            null,
            new  Name($dto->getNome()),
            new Email($dto->getEmail()),
            Senha::fromPlain($dto->getSenha())
        );

        $this->usuarioRepository->salvar($usuario);

    }

}