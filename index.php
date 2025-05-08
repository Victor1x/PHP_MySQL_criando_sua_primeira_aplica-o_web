<?php

require_once "src/conexao-bd.php";
require_once "src/Modelo/Produto.php";

$query = "SELECT * FROM produtos ";
$pdo = Connection::createConnection();
$stmt = $pdo->prepare($query);
$stmt->execute();
$date = $stmt->fetchAll();

$coffeeMenuItems = [];
$lunchMenuItems = [];

function ordenarItems(array $items): array
{
  usort($items, fn ($a, $b): int =>  $a['preco'] <=> $b['preco'] // Comparação    numérica
  );
  return $items;
}

foreach ($date as $row) {
  if ($row["tipo"] === "Café") {
    $coffeeMenuItems[] = $row;
    $coffeeMenuItems = ordenarItems($coffeeMenuItems);
  } else {
    $lunchMenuItems[] = $row;
  }
}

$coffeeMenuItems = ordenarItems($coffeeMenuItems);
$lunchMenuItems = ordenarItems($lunchMenuItems);

$dadosCafe = array_map(
  fn(array $item): Produto => new Produto(
    $item["id"],
    $item['tipo'],
    $item['nome'],
    $item['descricao'],
    $item['imagem'],
    $item['preco']
  ),
  $coffeeMenuItems
);
var_dump($coffeeMenuItems);
var_dump($dadosCafe);
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">


  <title>Serenatto - Cardápio</title>
</head>

<body>
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
        <?php foreach ($dadosCafe as $coffeeItem) : ?>
          <div class="container-produto">
            <div class="container-foto">
              <img src=" img/<?= $coffeeItem->get_image() ?>">
            </div>
            <p><?= $coffeeItem->get_name() ?></p> <!--esse previacao sigifica php echo-->
            <p><?= $coffeeItem->get_description() ?></p>
            <p><?= "R$ " . $coffeeItem->get_price() ?></p>
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

        <?php foreach ($lunchMenuItems as  $lunchItem) : ?>
          <div class="container-produto">
            <div class="container-foto">
              <img src=" img/<?= $lunchItem['imagem'] ?>">
            </div>
            <p><?= $lunchItem['nome'] ?></p> <!--esse previacao sigifica php echo-->
            <p><?= $lunchItem['descricao'] ?></p>
            <p><?= "R$ " . $lunchItem['preco'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>
  <script src="js/index.js"></script>
</body>

</html>
