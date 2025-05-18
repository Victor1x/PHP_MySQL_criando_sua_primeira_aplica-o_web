<?php

namespace Crud\Infrastructure\Repository;

use Crud\Domain\Entity\Produto;
use Crud\Domain\Repository\ProdutoRepositoryInterface;
use Crud\Domain\ValueObject\ImageFilename;
use Crud\Domain\ValueObject\Money;
use PDO;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvar(Produto $produto): void
    {
        $sql = 'INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (:tipo, :nome, :descricao, :preco, :imagem)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':tipo' => $produto->getTipo(),
            ':nome' => $produto->getNome(),
            ':descricao' => $produto->getDescricao(),
            ':preco' => $produto->getPreco()->getAmount(),
            ':imagem' => $produto->getImagem()?->getFilename()
        ]);
    }

    public function buscarPorId(int $id): ?Produto
    {
        $sql = 'SELECT * FROM produtos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $dados = $stmt->fetch();

        if (!$dados) {
            return null;
        }

        return $this->criarProduto($dados);
    }

    public function buscarTodos(): array
    {
        $sql = 'SELECT * FROM produtos ORDER BY preco';
        $stmt = $this->pdo->query($sql);
        $produtos = [];

        while ($dados = $stmt->fetch()) {
            $produtos[] = $this->criarProduto($dados);
        }

        return $produtos;
    }

    public function buscarPorTipo(string $tipo): array
    {
        $sql = 'SELECT * FROM produtos WHERE tipo = :tipo ORDER BY preco';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':tipo' => $tipo]);
        $produtos = [];

        while ($dados = $stmt->fetch()) {
            $produtos[] = $this->criarProduto($dados);
        }

        return $produtos;
    }

    public function excluir(int $id): void
    {
        $sql = 'DELETE FROM produtos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function atualizar(Produto $produto): void
    {
        $sql = 'UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $produto->getId(),
            ':tipo' => $produto->getTipo(),
            ':nome' => $produto->getNome(),
            ':descricao' => $produto->getDescricao(),
            ':preco' => $produto->getPreco()->getAmount(),
            ':imagem' => $produto->getImagem()?->getFilename()
        ]);
    }

    private function criarProduto(array $dados): Produto
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            new Money($dados['preco'], 'BRL'),
            $dados['imagem'] ? new ImageFilename($dados['imagem']) : null
        );
    }
} 