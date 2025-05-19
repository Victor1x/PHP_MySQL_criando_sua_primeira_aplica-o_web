<?php
require_once __DIR__ . "/vendor/autoload.php";

use Crud\Application\Service\ListarProdutosService;
use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\ProdutoRepository;
use Crud\Presentation\Controller\ListarProdutosController;
use Crud\Presentation\Controller\Middleware\AuthMiddleware;

AuthMiddleware::check();
$connection = Connection::getConnection();
$produtoRepository = new ProdutoRepository($connection);
$listarProdutosService = new ListarProdutosService($produtoRepository);
$controller = new ListarProdutosController($listarProdutosService);
$dados = $controller->handle();
$todosProdutos = $dados['todosProdutos'];

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table{
            width: 90%;
            margin: auto 0;
        }
        table, th, td{
            border: 1px solid #000;
        }

        table th{
            padding: 11px 0 11px;
            font-weight: bold;
            font-size: 18px;
            text-align: left;
            padding: 8px;
        }

        table tr{
            border: 1px solid #000;
        }

        table td{
            font-size: 18px;
            padding: 8px;
        }
        .container-admin-banner h1{
            margin-top: 40px;
            font-size: 30px;
    </style>
</head>

<body>
    <section class="container-table">
        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Descricão</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todosProdutos as $Item) : ?>
                <tr>
                    <td><?= $Item->getNome() ?></td>
                    <td><?= $Item->getTipo() ?></td>
                    <td><?= $Item->getDescricao() ?></td>
                    <td><?= $Item->getPreco()->format() ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

</body>

</html>
