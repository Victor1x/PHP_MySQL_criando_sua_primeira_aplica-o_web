<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\BuscarProdutoPorIdDTO;
use Crud\Domain\Entity\Produto;
use Crud\Domain\Repository\ProdutoRepositoryInterface;

class BuscarProdutoService
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function executar(BuscarProdutoPorIdDTO $dto): ?Produto
    {
        return $this->produtoRepository->buscarPorId($dto->getId());
    }
}