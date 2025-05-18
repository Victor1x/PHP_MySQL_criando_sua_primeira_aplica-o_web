<?php

use Crud\Application\Service\CadastrarUsuarioService;
use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\UsuarioRepository;
use Crud\Presentation\Controller\CadastrarUsuarioController;

require_once __DIR__ . "/vendor/autoload.php";


$pdo = Connection::getConnection();

$usuarioRepository = new UsuarioRepository($pdo);
$usuarioService = new CadastrarUsuarioService($usuarioRepository);
$usuarioController = new CadastrarUsuarioController($usuarioService);

$usuarioController->handle($_POST);

if (isset($_POST['Cadastrar'])) header('Location: login.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Serenatto - Cadastro</title>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/admin.css"/>
    <link rel="stylesheet" href="css/cadastro.css"/>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon"/>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
            rel="stylesheet"
    />
</head>
<body>
<main>
    <section class="container-admin-banner">
        <a href="index.php">
            <img
                    src="img/logo-serenatto-horizontal.png"
                    class="logo-admin"
                    alt="logo-serenatto"
            /></a>
        <h1>Cadastro</h1>
        <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments"/>
    </section>
    <section class="container-form">
        <form method="post"

        >
            <div class="form-group">
                <label class="inputs" for="nome">Nome Completo :</label>
                <input type="text" id="nome" name="nome"
                       placeholder="Digite o seu nome"
                       required
                       class="inputs"/>
            </div>

            <div class="form-group">
                <label class="inputs" for="email">E-mail :</label>
                <input type="email" id="email" name="email" required
                       placeholder="Digite o seu e-mail"
                       class="inputs"/>

            </div>

            <div class="form-group">
                <label class="inputs" for="senha">Senha :</label>
                <input type="password"
                       id="senha" name="senha"
                       placeholder="Digite a sua senha"
                       required
                       class="inputs"
                />

            </div>
            <input
                    type="submit"
                    name="Cadastrar"
                    class="botao-cadastrar"
                    value="Cadastrar"/>
        </form>

        <div class="links">
            <p>Já tem uma conta? <a href="login.php">Fazer Login</a></p>
        </div>
    </section>
</main>
</body>
</html>
