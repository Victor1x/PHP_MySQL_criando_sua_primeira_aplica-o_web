<?php

namespace Crud\Presentation\Controller;

use Crud\Application\Service\ListarProdutosService;

class ListarProdutosController
{
    private ListarProdutosService $listarProdutosService;

    public function __construct(ListarProdutosService $listarProdutosService)
    {
        $this->listarProdutosService = $listarProdutosService;
    }

    public function handle(): array
    {
        $produtosCafe = $this->listarProdutosService->buscarPorTipo("Café")->getProdutos();
        $produtosAlmoco = $this->listarProdutosService->buscarPorTipo("Almoço")->getProdutos();
        $todosProdutos = $this->listarProdutosService->executar()->getProdutos();
        return [
            'cafe' => $produtosCafe,
            'almoco' => $produtosAlmoco,
            "todosProdutos" => $todosProdutos,
        ];
    }
} 