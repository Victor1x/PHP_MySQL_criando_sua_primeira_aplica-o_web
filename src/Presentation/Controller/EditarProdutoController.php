<?php
namespace Crud\Presentation\Controller;

use Crud\Application\DTO\EditarProdutoDTO;
use Crud\Application\Service\EditarProdutoService;

class EditarProdutoController
{
    private EditarProdutoService $editarProdutoService;

    public function __construct(EditarProdutoService $editarProdutoService)
    {
        $this->editarProdutoService = $editarProdutoService;
    }
    public function handle(array $request,?string $img = null): void
    {
        if (! isset($request['editar'])) {
            return;
        }

        $dto = new EditarProdutoDTO(
            $request['id'],
            $request['tipo'],
            $request['nome'],
            $request['descricao'],
            (float) $request['preco'],
            $img 
        );

        $this->editarProdutoService->executar($dto);
    }
}
