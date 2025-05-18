<?php

namespace Crud\Application\DTO;

class CadastrarProdutoDTO
{
    public function __construct(

        private string  $tipo,
        private string  $nome,
        private string  $descricao,
        private float   $preco,
        private ?string $imagem
    )
    {

    }

    public
    function getTipo(): string
    {
        return $this->tipo;
    }

    public
    function getNome(): string
    {
        return $this->nome;
    }

    public
    function getDescricao(): string
    {
        return $this->descricao;
    }

    public
    function getPreco(): float
    {
        return $this->preco;
    }

    public
    function getImagem(): ?string
    {
        return $this->imagem;
    }
}
