<?php

namespace Crud\Domain\Entity;

use Crud\Domain\ValueObject\Email;
use Crud\Domain\ValueObject\Name;
use Crud\Domain\ValueObject\Senha;


final class Usuario
{
    public function __construct(
        private ?int  $id,
        private Name $nome,
        private Email  $email,
        private Senha  $senha
    ) {}

    // --- Getters individuais ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        // casting para string chama __toString() do Value Object Email
        return (string) $this->email;
    }

    public function getSenha(): Senha
    {
        // Expõe apenas o hash, não o objeto inteiro
        return $this->senha;
    }

    // --- ou, se precisar de um array de saída ---

    /**
     * Retorna um array associativo com os dados do usuário
     * prontos para, por exemplo, serializar em JSON.
     */
    public function toArray(): array
    {
        return [
            'id'    => $this->getId(),
            'nome'  => $this->getNome(),
            'email' => $this->getEmail(),
            // normalmente não expomos a senha em APIs, mas incluí se for o caso:
            'senha' => $this->getSenha()->getHash(),
        ];
    }
}
