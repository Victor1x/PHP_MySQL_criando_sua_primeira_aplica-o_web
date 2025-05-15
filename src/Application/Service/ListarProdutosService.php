<?php

namespace Crud\Application\Service;

use Crud\Application\DTO\ListarProdutosDTO;
use Crud\Domain\Repository\ProdutoRepositoryInterface;

class ListarProdutosService
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function executar(): ListarProdutosDTO
    {
        $produtos = $this->produtoRepository->buscarTodos();
        return new ListarProdutosDTO($produtos);
    }

    public function buscarPorTipo(string $tipo): ListarProdutosDTO
    {
        $produtos = $this->produtoRepository->buscarPorTipo($tipo);
        return new ListarProdutosDTO($produtos);
    }


}