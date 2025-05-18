<?php

namespace Crud\Domain\ValueObject;
// Define o namespace da classe, organizando-a dentro da arquitetura do domínio

use InvalidArgumentException;

// Importa a exceção que será lançada em caso de email inválido

/**
 * Class Email
 *
 * Value Object que representa um endereço de email.
 * Garante que apenas valores válidos sejam armazenados e mantêm imutabilidade.
 */
final class Email
{
    /**
     * @var string $email
     *
     * Armazena o email validado. É private para impedir alteração externa.
     */
    private string $email;

    /**
     * Email constructor.
     *
     * Recebe um endereço de email em texto puro, valida seu formato
     * e, se for válido, o armazena. Caso contrário, lança exceção.
     *
     * @param string $email O endereço de email em texto puro
     * @throws InvalidArgumentException Se o formato do email for inválido
     */
    public function __construct(string $isEmailVerified)
    {
        $this->validateEmail($isEmailVerified);

        // Se passou na validação, atribui o valor à propriedade interna
        $this->email = $this->removeSpaces($isEmailVerified);
    }


    private function validateEmail(string $isEmailVerified): void
    {
        if (empty($isEmailVerified)) {
            throw new InvalidArgumentException('O campo email é obrigatório.');
        }
        // Usa a função nativa filter_var para validar o formato do email.
        // FILTER_VALIDATE_EMAIL retorna o email se válido, ou false se inválido.
        if (!filter_var($isEmailVerified, FILTER_VALIDATE_EMAIL)) {
            // Lança uma InvalidArgumentException informando qual valor foi rejeitado
            throw new InvalidArgumentException("Email inválido: $isEmailVerified");
        }
        if (strlen($isEmailVerified) > 255) {
            throw new InvalidArgumentException( 'O e-mail deve ter no máximo 254 caracteres.');
        }
    }

    private function removeSpaces(string $isEmailVerified): string
    {
        return trim($isEmailVerified);
    }


    /**
     * __toString mágico
     *
     * Permite que o objeto seja convertido diretamente para string,
     * retornando o email armazenado.
     *
     * @return string O email validado
     */
    public function __toString(): string
    {
        // Retorna a propriedade $email quando, por exemplo, fizermos (string)$objetoEmail
        return $this->email;
    }


}