<?php

namespace Crud\Domain\Repository;

use Crud\Domain\Entity\Usuario;

interface UsuarioRepositoryInterface
{
    public function salvar(Usuario $usuario): void;

    public function buscarPorUsuario(string $usuario): ?Usuario;


}