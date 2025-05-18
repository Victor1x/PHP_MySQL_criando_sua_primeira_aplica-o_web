<?php

namespace Crud\Application\DTO;

class CadastrarUsuarioDTO

{
    public function __construct(

        private string $nome,
        private string $email,
        private string $senha,
    )
    {
    }

    public function getNome(): string
    {
        return $this->nome;
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