<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\CadastrarProdutoDTO;
use Crud\Domain\Entity\Produto;
use Crud\Domain\Repository\ProdutoRepositoryInterface;
use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;

class CadastrarProdutoService
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function executar(CadastrarProdutoDTO $dto): void
    {
        $produto = new Produto(
            null,
            $dto->getTipo(),
            $dto->getNome(),
            $dto->getDescricao(),
            new Money($dto->getPreco(), 'BRL'),
            new ImageFilename($dto->getImagem())
        );

        $this->produtoRepository->salvar($produto);
    }
}