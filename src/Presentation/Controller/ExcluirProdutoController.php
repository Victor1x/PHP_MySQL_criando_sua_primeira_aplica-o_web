<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\ExcluirProdutoDTO;
use Crud\Application\Service\ExcluirProdutoService;

class ExcluirProdutoController
{
    private ExcluirProdutoService $excluirProdutoService;

    public function __construct(ExcluirProdutoService $excluirProdutoService)
    {
        $this->excluirProdutoService = $excluirProdutoService;
    }

    public function handle(int $id): void
    {
        $dto = new ExcluirProdutoDTO($id);
        $this->excluirProdutoService->executar($dto);
    }
}