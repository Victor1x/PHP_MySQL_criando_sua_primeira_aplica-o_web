<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\CadastrarUsuarioDTO;
use Crud\Application\Service\CadastrarUsuarioService;


class CadastrarUsuarioController
{
    private CadastrarUsuarioService $cadastrarUsuarioService;

    public function __construct(CadastrarUsuarioService $cadastrarUsuarioService)
    {
        $this->cadastrarUsuarioService = $cadastrarUsuarioService;
    }

    public function handle(array $request): void
    {

        if (!$this->hasCadastroIntent($request)) {
            return;
        }

        $dto = $this->mapToDTO($request);

        $this->cadastrarUsuarioService->executar($dto);
    }

    private function hasCadastroIntent(array $request): bool
    {
//        echo "<pre>";
//var_dump($request);die;
        return isset($request['Cadastrar']); //isset verifica se a variável existe e não é NULL
    }


    private function mapToDTO(array $dados): CadastrarUsuarioDTO
    {
        return new CadastrarUsuarioDTO(
            $dados['nome'],
            $dados['email'],
            $dados['senha'],

        );
    }
}

