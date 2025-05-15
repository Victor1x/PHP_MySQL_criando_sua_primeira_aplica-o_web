<?php

namespace Crud\Application\DTO;

class ListarProdutosDTO
{
    private array $produtos;

    public function __construct(array $produtos)
    {
        $this->produtos = $produtos;
    }

    public function getProdutos(): array
    {
        return $this->produtos;
    }
} 