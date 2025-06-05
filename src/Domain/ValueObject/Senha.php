<?php
namespace Crud\Domain\ValueObject;

use InvalidArgumentException;
use RuntimeException;

final class Senha
{
    /**
     * O hash gerado por password_hash().
     *
     * @var string
     */
    private string $hash;

    /**
     * Construtor privado: recebe sempre um hash pronto para uso.
     *
     * @param string $hash
     */
    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Cria um objeto Senha a partir de texto puro:
     * - Valida complexidade mínima
     * - Gera e armazena o hash seguro
     *
     * @param string $password
     * @return self
     * @throws InvalidArgumentException Se falhar nas regras de complexidade
     * @throws RuntimeException If password_hash() falhar
     */
    public static function fromPlain(string $password): self
    {
        self::validateComplexidade($password);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (!$hash) {
            throw new RuntimeException('Falha ao gerar o hash da senha.');
        }

        return new self($hash);
        //Esse new self(...) é equivalente a new Senha(...), porém sem “grudar” o nome da classe no código.
        // Se você renomear a classe, não precisa trocar esse trecho.
    }

    /**
     * Cria um objeto Senha a partir de um hash já existente (por exemplo, vindo do banco).
     *
     * @param string $hash
     * @return self
     */
    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    /**
     * Verifica se a senha em texto puro corresponde a este hash.
     *
     * @param string $password
     * @return bool
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->hash);
    }

    /**
     * Retorna o hash pronto para persistência (INSERT/UPDATE).
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * Garante que a senha atende aos critérios mínimos de segurança:
     * - ao menos 8 caracteres
     * - pelo menos uma letra maiúscula
     * - pelo menos uma letra minúscula
     * - pelo menos um dígito
     * - pelo menos um caractere especial
     *
     * @param string $password
     * @throws InvalidArgumentException
     */
    private static function validateComplexidade(string $password): void
    {
        if (mb_strlen($password) < 8) {
            throw new InvalidArgumentException('A senha deve ter ao menos 8 caracteres.');
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new InvalidArgumentException('A senha deve conter ao menos uma letra maiúscula.');
        }
        if (!preg_match('/[a-z]/', $password)) {
            throw new InvalidArgumentException('A senha deve conter ao menos uma letra minúscula.');
        }
        if (!preg_match('/\d/', $password)) {
            throw new InvalidArgumentException('A senha deve conter ao menos um número.');
        }
        if (!preg_match('/[\W_]/', $password)) {
            throw new InvalidArgumentException('A senha deve conter ao menos um caractere especial.');
        }
    }
}
