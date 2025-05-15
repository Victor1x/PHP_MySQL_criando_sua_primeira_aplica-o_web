<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\EditarProdutoDTO;
use Crud\Domain\Entity\Produto;
use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;
use Crud\Infrastructure\Repository\ProdutoRepository;

class EditarProdutoService
{
    private ProdutoRepository $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepository)
    {
       $this->produtoRepository = $produtoRepository;
    }

    public function executar(EditarProdutoDTO $dto): void
    {
        $produto = new Produto(
            $dto->getId(),
            $dto->getTipo(),
            $dto->getNome(),
            $dto->getDescricao(),
            new Money($dto->getPreco(), 'BRL'),
            new ImageFilename($dto->getImagem())
        );
        $this->produtoRepository->atualizar($produto);
    }
}