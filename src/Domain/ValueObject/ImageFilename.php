<?php
namespace Crud\Domain\ValueObject;

use InvalidArgumentException;

final class ImageFilename
{
  private string $filename;

  public function __construct(string $filename)
  {
    if (trim($filename) === '') {
      throw new InvalidArgumentException("Nome de arquivo inválido.");
    }
    $this->filename = $filename;
  }

  public function getFilename(): string
  {
    return $this->filename;
  }

  public function getPath(): string
  {
    return "img/{$this->filename}";
  }

  public function equals(ImageFilename $other): bool
  {
    return $this->filename === $other->filename;
  }
}
