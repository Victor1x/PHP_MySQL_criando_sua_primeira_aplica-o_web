<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\ExcluirProdutoDTO;
use Crud\Domain\Repository\ProdutoRepositoryInterface;

class ExcluirProdutoService
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function executar(ExcluirProdutoDTO $dto): void
    {
        $this->produtoRepository->excluir($dto->getId());
    }
}