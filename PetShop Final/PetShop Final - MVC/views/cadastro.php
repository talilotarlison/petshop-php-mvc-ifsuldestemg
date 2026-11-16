<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página de Cadastro - PetShop</title>
        <link rel="stylesheet" href="./public/css/cadastro.css">
    </head>

    <body>
        <div class="signup-container">
            <h2>Cadastro</h2>
            <form action="./cadastro" method="POST">
                <?php if (!empty($mensagem)): ?>
                    <p style="color:blue"><?php echo htmlspecialchars($mensagem); ?></p>
                <?php endif; ?>

                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="input-group">
                    <label for="data-nascimento">Data de Nascimento</label>
                    <input type="date" id="data-nascimento" name="data-nascimento" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Escolha uma senha" required>
                </div>
                <div class="input-group">
                    <label for="confirmar-senha">Confirmar Senha</label>
                    <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Repita a senha"
                        required>
                </div>
                <button type="submit" class="button">Cadastrar</button>
            </form>
            <div class="link">
                <p>Já tem uma conta? <a href="./login">Faça login</a></p>
            </div>
        </div>
    </body>

</html>