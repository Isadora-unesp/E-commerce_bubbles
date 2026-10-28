<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Fruit Bubbles</title>

    <link rel="stylesheet" href="styleCLP.css">
</head>

<body>

    <a href="index.php" class="voltar-index"
       aria-label="Voltar para a página inicial">
        <span>←</span> Voltar
    </a>

    <!-- Conteúdo principal da página -->
    <main class="container">

        <section class="cadastro">

            <h1>Login</h1>

            <!-- Informações do perfil -->
            <div class="foto-perfil-container">
                <img
                    src="https://placehold.co/120x120/fff2e8/46220f?text=FB"
                    alt="Imagem padrão da Fruit Bubbles"
                    class="foto-perfil"
                >
            </div>

            <p class="mensagem">
                Entre na sua conta para continuar
            </p>

            <?php if (isset($_GET['erro'])) { ?>
                <p class="erro">
                    Email ou senha incorretos.
                </p>
            <?php } ?>

            <!-- Formulário de login -->
            <form method="post" action="crudUsuarios/loginUsuario.php">

                <?php if (
                    isset($_GET['retorno']) &&
                    $_GET['retorno'] === 'carrinho'
                ) { ?>
                    <input
                        type="hidden"
                        name="retorno"
                        value="carrinho"
                    >
                <?php } ?>

                <div class="campo">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu email"
                        required
                    >
                </div>

                <div class="campo">
                    <label for="senha">Senha</label>
                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <a href="esqueci.php" class="esqueceu-senha">
                    Esqueceu sua senha?
                </a>

                <button type="submit">Entrar</button>

            </form>

            <p class="login">
                Ainda não possui uma conta?
                <a href="cadastro.php">Cadastre-se</a>
            </p>

        </section>

    </main>

</body>

</html>