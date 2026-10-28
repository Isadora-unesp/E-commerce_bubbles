<?php
include "util.php";

// Conecta ao banco de dados e valida o token de recuperação de senha
$conn  = conecta();
$token = $_GET['token'] ?? '';
$email = ValidaTokenRecuperacao($conn, $token);

$erro    = "";
$sucesso = false;

// Se o token for válido e o formulário for enviado, processa a redefinição de senha
if ($email !== null && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $senha1 = $_POST['senha1'] ?? '';
    $senha2 = $_POST['senha2'] ?? '';

    if (strlen($senha1) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } elseif ($senha1 !== $senha2) {
        $erro = "As senhas estão diferentes.";
    } else {
        $st = $conn->prepare("UPDATE usuario SET senha = :s WHERE email = :e");
        $st->execute([
            ':s' => password_hash($senha1, PASSWORD_DEFAULT),
            ':e' => $email
        ]);
        $sucesso = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha | Fruit Bubbles</title>
    <link rel="stylesheet" href="styleCLP.css">
</head>
<body>

    <a href="login.php" class="voltar-index"><span>←</span> Voltar</a>

    <!-- Conteúdo principal da página -->
    <main class="container">

        <!-- Formulário de redefinição de senha -->
        <section class="cadastro">

            <h1>Redefinir senha</h1>

            <?php if ($sucesso) { ?>

                <p class="mensagem" style="color:#2e7d32;font-weight:600;">
                    Senha alterada com sucesso!
                </p>
                <p class="login"><a href="login.php">Ir para o login</a></p>

            <?php } elseif ($email === null) { ?>

                <p class="mensagem" style="color:#c62828;font-weight:600;">
                    Link inválido ou expirado.
                </p>
                <p class="login"><a href="esqueci.php">Solicitar novo link</a></p>

            <?php } else { ?>

                <?php if ($erro) { ?>
                    <p class="mensagem" style="color:#c62828;font-weight:600;">
                        <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php } ?>

                <form method="post" action="">
                    <div class="campo">
                        <label for="senha1">Nova senha</label>
                        <input type="password" id="senha1" name="senha1" required>
                    </div>
                    <div class="campo">
                        <label for="senha2">Redigite a senha</label>
                        <input type="password" id="senha2" name="senha2" required>
                    </div>
                    <button type="submit">Alterar</button>
                </form>

            <?php } ?>

        </section>
    </main>

</body>
</html>