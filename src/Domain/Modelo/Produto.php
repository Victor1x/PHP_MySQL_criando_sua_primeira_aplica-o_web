<?php

namespace Crud\Domain\Modelo;

use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;
class Produto
{
  public function __construct(
    private int $id,
    private string $type,
    private string $name,
    private string $description,
    private ImageFilename $image,
    private Money $price,
  ) {}

  public function get_id(): int
  {
    return $this->id;
  }

  public function get_type(): string
  {
    return $this->type;
  }
  public function get_name(): string
  {
    return $this->name;
  }
  public function get_description(): string
  {
    return $this->description;
  }
  public function get_image(): ImageFilename
  {
    return $this->image;
  }

  public function get_price(): Money
  {
    return $this->price;
  }

  public function getAll(): array
  {
    return get_object_vars($this); // PUXAR TODOS OS DADOS GET EM SO UM METODOS mais funcina si os metodos for publucos
  }
}

// objeto de valor cria um classa para um propiedade que vc vai usar na classa principal
