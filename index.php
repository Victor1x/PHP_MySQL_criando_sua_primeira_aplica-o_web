<?php

require_once __DIR__ . "/vendor/autoload.php";

use Crud\Application\Service\ListarProdutosService;
use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\ProdutoRepository;
use Crud\Presentation\Controller\ListarProdutosController;

$connection = Connection::getConnection();
$produtoRepository = new ProdutoRepository($connection);
$listarProdutosService = new ListarProdutosService($produtoRepository);
$controller = new ListarProdutosController($listarProdutosService);

$dados = $controller->handle();

$dadosCafe = $dados['cafe'];
$dadoslunch = $dados['almoco'];
?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">


    <title>Serenatto - Cardápio</title>
</head>

<body>
<header>
        <nav>
            <ul class="ul__header">
                <li class="li__header"><img src="img/icone-serenatto.png" alt=""></li>
                <li class="li__header" ><a href="View/login.php">Login</a></li>
                
            </ul>
        </nav>
    </header>
<main>
<main>
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    <h2>Cardápio Digital</h2>
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Opções para o Café</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosCafe as $coffeeItem): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $coffeeItem->getImagem()->getPath() ?>" alt="fotos do produtos">
                    </div>
                    <p><?= $coffeeItem->getNome() ?></p>   <!--esse previacao sigifica =-->
                    <p><?= $coffeeItem->getDescricao() ?></p>
                    <p><?= $coffeeItem->getPreco()->format() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">

            <?php foreach ($dadoslunch as $lunchItem): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $lunchItem->getImagem()->getPath() ?>" alt="fotos do produtos">
                    </div>
                    <p><?= $lunchItem->getNome() ?></p> <!--esse previacao sigifica =-->
                    <p><?= $lunchItem->getDescricao() ?></p>
                    <p><?= $lunchItem->getPreco()->format() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<script src="js/index.js"></script>
</body>

</html>
