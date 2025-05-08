<?php

class Produto
{
  public function __construct(
    private int $id,
    private string $type,
    private string $name,
    private string $description,
    private string $image,
    private float $price,
  ) {
    $this->id = $id;
    $this->type = $type;
    $this->name = $name;
    $this->description = $description;
    $this->image = $image;
    $this->price = $price;
  }

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
  public function get_image(): string
  {
    return $this->image;
  }
  public function get_price():float
  {
    return $this->price;
  }
}
