<?php
namespace Crud\Application\DTO;

class CadastrarProdutoDTO
{
    private string $tipo;
    private string $nome;
    private string $descricao;
    private float $preco;
    private ?string $imagem;

    public function __construct(
        string $tipo,
        string $nome,
        string $descricao,
        float $preco,
        ?string $imagem = null
    ) {
        $this->tipo      = $tipo;
        $this->nome      = $nome;
        $this->descricao = $descricao;
        $this->preco     = $preco;
        $this->imagem = $imagem;
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

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getImagem(): ?string
    {
        return $this->imagem;
    }
}
