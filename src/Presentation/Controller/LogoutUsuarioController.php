<?php

namespace Crud\Presentation\Controller;

class LogoutUsuarioController
{
    // Método para destruir a sessão e deslogar o usuário
    public function handle(): void
    {
        // Se a sessão não estiver iniciada, inicia agora
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Inicia sessão PHP
        }

        // Limpa todas as variáveis de sessão
        $_SESSION = [];

        // Se o PHP estiver usando cookies para sessão, remove o cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params(); // Pega os parâmetros do cookie atual
            setcookie(
                session_name(),        // Nome do cookie de sessão
                '',                    // Valor vazio
                time() - 42000,        // Data no passado para expirar o cookie
                $params['path'],       // Mesmo caminho do cookie anterior
                $params['domain'],     // Mesmo domínio
                $params['secure'],     // Mesma configuração de segurança
                $params['http                               only']    // Mesma configuração de HTTP only
            );
        }

        // Destroi a sessão no servidor
        session_destroy();

        // Redireciona para a página de login
        header('Location: login.php');

        exit; // Encerra o script
    }
}
