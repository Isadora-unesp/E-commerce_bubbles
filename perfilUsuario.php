<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

include("util.php");

$conn = conecta();

$id = $_SESSION['usuario_id'];

$varSQL = "SELECT *
           FROM usuario
           WHERE id_usuario = :id
           AND (excluido = false OR excluido IS NULL)";

$select = $conn->prepare($varSQL);

$select->bindParam(':id', $id);

$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

if (!$linha) {
    echo "Usuário não encontrado.";
    exit;
}

$nome = $linha['nome'];
$email = $linha['email'];
$telefone = $linha['telefone'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil | Fruit Bubbles</title>
    <link rel="stylesheet" href="styleCLP.css">
</head>

<body>

    <main class="container">

        <section class="perfil">

            <h1>Meu Perfil</h1>
            <p class="mensagem">
                Veja suas informações pessoais
            </p>

            <div class="informacoes">

                <div class="campo">
                    <span class="titulo">Nome</span>
                    <p><?php echo htmlspecialchars($nome); ?></p>
                </div>
                <div class="campo">
                    <span class="titulo">Email</span>
                    <p><?php echo htmlspecialchars($email); ?></p>
                </div>
                <div class="campo">
                    <span class="titulo">Telefone</span>
                    <p><?php echo htmlspecialchars($telefone); ?></p>
                </div>

            </div>

            <div class="botoes">

                <a class="editar" href="editarPerfil.php">Editar Perfil</a>

                <a class="sair" href="logout.php">Logout</a>

            </div>

        </section>

    </main>

</body>

</html>