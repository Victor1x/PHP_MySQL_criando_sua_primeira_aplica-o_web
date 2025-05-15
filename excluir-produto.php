<?php

require_once __DIR__ . "/vendor/autoload.php";

use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\ProdutoRepository;
use Crud\Application\Service\ExcluirProdutoService;
use Crud\Presentation\Controller\ExcluirProdutoController;

if (!isset($_POST['id'])) {
   header("Location: admin.php");
   exit;
}

$pdo = Connection::getConnection();
$produtoRepository = new ProdutoRepository($pdo);
$excluirProdutoService = new ExcluirProdutoService($produtoRepository);
$controller = new ExcluirProdutoController($excluirProdutoService);

$controller->handle((int)$_POST['id']);
header("Location: admin.php");