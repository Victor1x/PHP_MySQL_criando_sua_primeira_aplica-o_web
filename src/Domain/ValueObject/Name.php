<?php

namespace Crud\Domain\ValueObject;

use InvalidArgumentException;

class Name
{
    private string $name;

    public function __construct(string $isNameValid)
    {
        $this->validateName($isNameValid);

        $this->name = trim($isNameValid);
    }

    private function validateName(string $isNameValid): void
    {
        if (empty($isNameValid)) throw new InvalidArgumentException('O campo "nome" é obrigatório.');
        if (strlen($isNameValid) > 255) throw new InvalidArgumentException('O nome deve ter no máximo 254 caracteres.');

    }

    public function __toString(): string
    {
        // Retorna a propriedade $email quando, por exemplo, fizermos (string)$objetoEmail
        return $this->name;
    }
}