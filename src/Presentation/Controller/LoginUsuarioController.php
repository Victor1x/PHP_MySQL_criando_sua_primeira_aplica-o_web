<?php

namespace Crud\Presentation\Controller;

use Crud\Application\DTO\LoginUsuarioDTO;
use Crud\Application\Service\LoginUsuarioService;
use InvalidArgumentException;

class LoginUsuarioController
{
    private LoginUsuarioService $loginUsuarioService;

    // Injeta o serviço de login no controller
    public function __construct(LoginUsuarioService $loginUsuarioService)
    {
        $this->loginUsuarioService = $loginUsuarioService;
    }

    // Método principal que processa o request de login

    public function handle(array $loginSenha): void
    {
        // Se a sessão não estiver iniciada, inicia agora

        if (session_status() === PHP_SESSION_NONE) {
            session_start();  // Inicia sessão PHP
        }
        // verifica se email e senha nao esta vazio
        if (empty($loginSenha['email']) || empty($loginSenha['senha'])) {
            header("login.php");// retoma para o login.php
            return;
        }

        $dto = $this->mapToDTO($loginSenha);// cria o DTO

        try {
            $usuario = $this->loginUsuarioService->executar($dto); // Tenta autenticar o usuário e receber objeto Usuário

            $_SESSION['usuario_id'] = $usuario->getId();// Se autenticou, armazena o ID do usuário na sessão

            // Gera um novo ID de sessão para evitar session fixation
            session_regenerate_id(true);
            // Redireciona para a área restrita (admin.php)
            header('Location: admin.php');

            exit;  // Encerra o script após o redirect
        } catch (InvalidArgumentException $e) {
            // Se falhou, armazena a mensagem de erro na sessão
            $_SESSION['login_error'] = $e->getMessage();

            // Redireciona de volta para a página de login
            header('Location: login.php');
            exit;// Encerra o script
        }
    }

    private function mapToDTO(array $loginSenha): LoginUsuarioDTO
    {
        return new LoginUsuarioDTO(
            filter_var($loginSenha['email'], FILTER_VALIDATE_EMAIL) ?: '',
            (string) $loginSenha['senha']
        );
    }



}