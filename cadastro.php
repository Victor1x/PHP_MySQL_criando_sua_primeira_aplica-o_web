<?php
require_once __DIR__ . "/vendor/autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aqui virá a lógica de cadastro
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serenatto - Cadastro</title>
    <link rel="stylesheet" href="css/reset.css">
    
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <section class="container-cadastro">
            <div class="cadastro-logo">
                <img src="img/logo-serenatto-horizontal.png" alt="Logo Serenatto">
            </div>
            
            <div class="cadastro-form">
                <h1>Criar Conta</h1>
                
                <form action="cadastro.php" method="post">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                    </div>

                    <button type="submit" class="botao-cadastrar">Cadastrar</button>
                </form>

                <div class="links">
                    <p>Já tem uma conta? <a href="login.html">Fazer Login</a></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html> 