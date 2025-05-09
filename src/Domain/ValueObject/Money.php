<?php
namespace Crud\Domain\ValueObject;

use InvalidArgumentException;

final class Money{
    private float  $amount;
    private string $currency;

    public function __construct(float $amount, string $currency = 'BRL')
    {
        if ($amount < 0) {
            throw new InvalidArgumentException("O valor não pode ser negativo: {$amount}");
        }
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function format(): string
    {
        // formata com separador de milhar e duas casas decimais
        return "R$ ". number_format($this->amount, 2, ',', '.')  ;
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount
            && $this->currency === $other->currency;
    }
}


