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


// $dados = $ProdutoRepository->findAll();

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
  <link rel="stylesheet" href="css/admin.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Admin</title>
</head>

<body>
<header>
    <nav>
        <ul class="ul__header">
            <li class="li__header"><img src="img/icone-serenatto.png" alt=""></li>
            <li class="li__header" ><a href="logout.php">Sair</a></li>

        </ul>
    </nav>
</header>
  <main>
    <section class="container-admin-banner">
      <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
      <h1>Admistração</h1>
      <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <h2>Lista de Produtos</h2>

    <section class="container-table">
      <table>
        <thead>
          <tr>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Descricão</th>
            <th>Valor</th>
            <th colspan="2">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($todosProdutos as $Item) : ?>
            <tr>
              <td><?= $Item->getNome() ?></td>
              <td><?= $Item->getTipo() ?></td>
              <td><?= $Item->getDescricao() ?></td>
              <td><?= $Item->getPreco()->format() ?></td>
              <td><a class="botao-editar" href="editar-produto.php?id=<?=$Item->getId()?>">Editar</a></td>
              <td>
                  <form action="excluir-produto.php" method="post">
                      <input type="hidden" name="id" value="<?= $Item->getId()?>">
                      <button type="submit" class="botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                          Excluir
                      </button>
                  </form>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="conteiner__link_cadasto__form_baixar">
        <a class="botao-cadastrar" href="cadastrar-produto.php">Cadastrar produto</a>
        <form action="gerador-pdf.php" >
          <input type="submit" class="botao-cadastrar" value="Baixar Relatório" />
        </form>
      </div>
    </section>
  </main>
<script src="js/destroy_session.js"></script>
</body>

</html>
