<?php
namespace Crud\Infrastructure\Repository;

use Crud\Domain\Modelo\Produto;
use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;
use PDO;

class ProdutoRepositoryPdo
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function findAllByType(string $type): array
  {
    $query = "SELECT * FROM produtos WHERE tipo = :tipo ORDER BY preco";

    $stmt = $this->pdo->prepare($query);

    $stmt->execute([":tipo" => $type]);

    $data = $stmt->fetchAll();

    return $this->hydrateList($data);
  }

  public function findAll():array{
    $query = "SELECT * FROM produtos ORDER BY preco";

    $stmt = $this->pdo->prepare($query);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $this->hydrateList($data);
  }

  private function hydrateList(array $list): array
  {
    return array_map(
      fn(array $data): Produto => new Produto(
        $data["id"],
        $data['tipo'],
        $data['nome'],
        $data['descricao'],
        new ImageFilename((string) $data['imagem']),
        new Money((float) $data["preco"], 'BRL')
      ),
      $list
    );
  }
}
