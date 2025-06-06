<?php



use Crud\Application\Service\LoginUsuarioService;
use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\UsuarioRepository;
use Crud\Presentation\Controller\LoginUsuarioController;

require_once __DIR__ . "/../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();  // Inicia sessão PHP
}
if (isset($_SESSION['usuario_id'])) {
  header('Location: admin.php');
}
$pdo = Connection::getConnection();
$usuarioRepository = new UsuarioRepository($pdo);
$usuarioService = new LoginUsuarioService($usuarioRepository);
$usuarioController = new LoginUsuarioController($usuarioService);
$usuarioController->handle($_POST);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/index.css"/>
    <link rel="stylesheet" href="../css/admin.css"/>
    <link rel="stylesheet" href="../css/form.css"/>
    <link rel="icon" href="../img/icone-serenatto.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="icon" href="../img/icone-serenatto.png" type="image/x-icon"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
            rel="stylesheet"
    />
    <link
            href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap"
            rel="stylesheet"
    />
    <title>Serenatto - Login</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <a href="../index.php">
        <img
                src="../img/logo-serenatto-horizontal.png"
                class="logo-admin"
                alt="logo-serenatto"
        /></a>
        <h1>Login</h1>
        <img class="ornaments" src="../img/ornaments-coffee.png" alt="ornaments"/>
    </section>
    <section class="container-form">
        <form method="post">
            <label for="email">E-mail :</label>
            <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite o seu e-mail"

            />

            <label for="password">Senha :</label>
            <input
                    type="password"
                    id="password"
                    name="senha"
                    placeholder="Digite a sua senha"

            />

            <input type="submit" name="login" class="botao-cadastrar" value="Entrar"/>
            <div class="links">
                <p>Não tens uma conta? <a href="cadastro-usuario.php">Regista-te</a></p>
            </div>
        </form>

    </section>
</main>
</body>
</html>
