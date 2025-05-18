<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\LoginUsuarioDTO;
use Crud\Application\Service\LoginUsuarioService;

class LoginUsuarioController
{
    private LoginUsuarioService $loginUsuarioService;

    public function __construct(LoginUsuarioService $loginUsuarioService)
    {
        $this->loginUsuarioService = $loginUsuarioService;
    }

    public function handle(array $loginSenha): void
    {
        if (!$this->hasCadastroIntent($loginSenha)) {
            return;
        }
        $dto = $this->mapToDTO($loginSenha);

        $this->loginUsuarioService->executar($dto);

        header('Location: admin.php');

    }

    private function hasCadastroIntent(array $request): bool
    {
//        echo "<pre>";
//var_dump($request);die;
        return isset($request['login']); //isset verifica se a variável existe e não é NULL
    }

    private function mapToDTO(array $loginSenha): LoginUsuarioDTO
    {
        return new LoginUsuarioDTO(
            $loginSenha['email'],
            $loginSenha['senha']
        );
    }
}