<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\CadastrarProdutoDTO;
use Crud\Application\Service\CadastrarProdutoService;

class CadastrarProdutoController
{
    private CadastrarProdutoService $cadastrarProdutoService;

    public function __construct(CadastrarProdutoService $cadastrarProdutoService)
    {
        $this->cadastrarProdutoService = $cadastrarProdutoService;
    }

    public function handle(array $request,?string $img = null): void
    {
        if (!isset($request['cadastro'])) {
            return;
        }
      

        $dto = new CadastrarProdutoDTO(
            $request['tipo'],
            $request['nome'],
            $request['descricao'],
            (float) $request['preco'],
             $img
        );

        $this->cadastrarProdutoService->executar($dto);
    }
} 