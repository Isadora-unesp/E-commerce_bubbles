<?php
include "util.php";

$msg = "";

// Se o formulário de recuperação de senha for enviado, processa a solicitação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');

    $conn = conecta();
    $st = $conn->prepare("SELECT senha FROM usuario
                          WHERE email = :e AND (excluido = false OR excluido IS NULL)");
    $st->execute([':e' => $email]);
    $hash = $st->fetchColumn();

    // so envia se o usuario existe, mas a resposta eh sempre a mesma
    // (assim ninguem descobre quais e-mails estao cadastrados)
    if ($hash !== false) {
        $token = GeraTokenRecuperacao($email, $hash);
        $link  = UrlBaseSite() . "/redefinir.php?token=" . $token;

        $html = "<h4>Redefinir sua senha</h4>
                 Clique no link para redefinir sua senha
                 (válido por " . RECUPERACAO_MINUTOS . " minutos):<br>
                 <a href='$link'>$link</a><br><br>
                 Se você não pediu isso, ignore este e-mail.";

        EnviaEmail($email, 'Recupere a sua senha - Fruit Bubbles', $html);
    }

    $msg = "Se o e-mail estiver cadastrado, enviamos o link de recuperação
            (verifique também a caixa de spam).";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha | Fruit Bubbles</title>
    <link rel="stylesheet" href="styleCLP.css">
</head>
<body>

    <a href="login.php" class="voltar-index"><span>←</span> Voltar</a>

    <!-- Conteúdo principal da página -->
    <main class="container">

        <!-- Formulário de recuperação de senha -->
        <section class="cadastro">

            <h1>Recuperar senha</h1>

            <p class="mensagem">
                Informe seu e-mail para receber o link de redefinição.
            </p>

            <?php if ($msg) { ?>
                <p class="mensagem" style="color:#2e7d32;font-weight:600;">
                    <?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php } ?>

            <!-- Formulário de preenchimento e envio -->
            <form method="post" action="">
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           placeholder="Digite seu email" required>
                </div>
                <button type="submit">Enviar</button>
            </form>

            <p class="login"><a href="login.php">Voltar ao login</a></p>

        </section>
    </main>

</body>
</html>