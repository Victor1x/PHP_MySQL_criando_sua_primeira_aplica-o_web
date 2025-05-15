<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\BuscarProdutoPorIdDTO;
use Crud\Application\Service\BuscarProdutoService;

class BuscarProdutoController
{
    private BuscarProdutoService $buscarProdutoService;

    public function __construct(BuscarProdutoService $buscarProdutoService)
    {
        $this->buscarProdutoService = $buscarProdutoService;
    }

    public function handle(int $id)
    {
        $dto = new BuscarProdutoPorIdDTO($id);
        return $this->buscarProdutoService->executar($dto);
    }
}