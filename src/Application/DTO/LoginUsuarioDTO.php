<?php

namespace Crud\Application\DTO;

class LoginUsuarioDTO
{
    private string $email;
    private string $senha;

    public function __construct(string $email, string $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }

}
