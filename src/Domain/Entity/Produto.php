<?php

namespace Crud\Domain\Entity;

use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;

class Produto
{


    public function __construct(
       private ?int $id,
       private string $tipo,
       private string $nome,
       private string $descricao,
       private Money $preco,
       private ?ImageFilename $imagem = null
    ) {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPreco(): Money
    {
        return $this->preco;
    }

    public function getImagem(): ?ImageFilename
    {
        return $this->imagem;
    }

    public function atualizar(
        string $tipo,
        string $nome,
        string $descricao,
        Money $preco,
        ?ImageFilename $imagem = null
    ): void {
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
    }
}
