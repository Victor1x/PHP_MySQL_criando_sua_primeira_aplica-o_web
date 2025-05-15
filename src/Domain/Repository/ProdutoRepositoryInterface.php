<?php

namespace Crud\Domain\Repository;

use Crud\Domain\Entity\Produto;

interface ProdutoRepositoryInterface
{
    public function salvar(Produto $produto): void;
    public function buscarPorId(int $id): ?Produto;
    public function buscarTodos(): array;
    public function buscarPorTipo(string $tipo): array;
    public function excluir(int $id): void;
    public function atualizar(Produto $produto): void;
} 