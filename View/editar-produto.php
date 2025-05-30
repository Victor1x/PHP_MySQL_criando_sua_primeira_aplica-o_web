<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Crud\Application\Service\BuscarProdutoService;
use Crud\Application\Service\EditarProdutoService;
use Crud\Infrastructure\Persistence\Connection;
use Crud\Infrastructure\Repository\ProdutoRepository;
use Crud\Presentation\Controller\BuscarProdutoController;
use Crud\Presentation\Controller\EditarProdutoController;
use Crud\Presentation\Controller\Middleware\AuthMiddleware;


if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit;
}
AuthMiddleware::check();
$connection = Connection::getConnection();
$produtoRepository = new ProdutoRepository($connection);

$buscarProdutoService = new BuscarProdutoService($produtoRepository);
$controller = new BuscarProdutoController($buscarProdutoService);

$produto = $controller->handle((int)$_GET['id']);

$editarProdutoService = new EditarProdutoService($produtoRepository);
$editarController = new EditarProdutoController($editarProdutoService);

if (isset($_FILES['imagem']) && empty($_FILES['imagem']['name'])) {
    $nomeImagem = $_FILES['imagem']['name'];
} else {
    $nomeImagem = $produto->getImagem()->getFileName();
}
if (isset($_POST['editar'])) {
    $editarController->handle($_POST, $nomeImagem);
    var_dump($_POST);
//    header("Location: admin.php");
    exit;
}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Editar Produto</title>
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
        <h1>Editar Produto</h1>
        <img class="ornaments" src="../img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">

        <form action="editar-produto.php?id=<?php echo $produto->getId() ?>"
              method="post"
              enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $produto->getId() ?>">

            <label for="nome">Nome</label>
            <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?php echo htmlspecialchars($produto->getNome()) ?>"
                    required
            >
            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input
                            type="radio"
                            id="cafe"
                            name="tipo"
                            value="Café"
                        <?php echo $produto->getTipo() === 'Café' ? 'checked' : '' ?>
                    >
                </div>
                <div>
                    <label for="almoco">Almoço</label>
                    <input
                            type="radio"
                            id="almoco"
                            name="tipo"
                            value="Almoço"
                        <?php echo $produto->getTipo() === 'Almoço' ? 'checked' : '' ?>
                    >
                </div>
            </div>


            <label for="descricao">Descrição</label>
            <input
                    type="text"
                    id="descricao"
                    name="descricao"
                    value="<?php echo htmlspecialchars($produto->getDescricao()) ?>"
                    required
            >

            <label for="preco">Preço</label>
            <input
                    type="text"
                    id="preco"
                    name="preco"
                    value="<?php echo $produto->getPreco()->getAmount() ?>"
                    required
            >
            <label for="imagem">Imagem (opcional)</label>
            <input
                    type="file"
                    name="imagem"
                    accept="image/*"
                    id="imagem"
                    placeholder="Envie uma imagem"
            >

            <input
                    type="submit"
                    name="editar"
                    class="botao-cadastrar"
                    value="Editar produto"/>

        </form>

    </section>
</main>

<script src="../js/index.js"></script>


</body>
</html>