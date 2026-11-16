<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - PetShop</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/login" method="POST">
            <?php if (!empty($mensagem)): ?>
                <p style="color:blue"><?php echo htmlspecialchars($mensagem); ?></p>
            <?php endif; ?>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
        <div class="link">
            <p>Ainda não tem uma conta? <a href="./cadastro">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>
