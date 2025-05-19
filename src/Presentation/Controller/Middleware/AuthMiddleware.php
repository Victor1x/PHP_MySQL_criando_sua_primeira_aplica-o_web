<?php
namespace Crud\Presentation\Controller\Middleware;

class AuthMiddleware
{

    // Verifica se o usuário está logado; se não, redireciona para login
    public static function check(): void
    {
        // Inicia sessão se ainda não tiver sido iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();  // Inicia sessão PHP
        }
        // Se não existe o usuário_id na sessão, não está logado
        if (empty($_SESSION['usuario_id'])) {
            header('Location: login.php'); // Redireciona para login
            exit;   // Encerra o script
        }
    }
}
