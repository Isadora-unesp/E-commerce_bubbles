<?php

session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

include("util.php");

$conn = conecta();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

    if (!isset($_GET['id'])) {
        header("Location: usuario.php");
        exit;
    }

    $id = $_GET['id'];

} else {

    $id = $_SESSION['usuario_id'];

}

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

$id = $linha['id_usuario'];
$nome = $linha['nome'];
$email = $linha['email'];
$telefone = $linha['telefone'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Alterar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Alterar Usuário</h2>

    <form action="updateUsuario.php" method="post">

        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

        <?php } ?>

        <label>Nome</label>

        <input type="text"
               name="nome"
               maxlength="80"
               value="<?php echo htmlspecialchars($nome); ?>"
               required>

        <label>Email</label>

        <input type="email"
               name="email"
               maxlength="100"
               value="<?php echo htmlspecialchars($email); ?>"
               required>

        <label>Nova Senha</label>

        <input type="password"
               name="senha"
               placeholder="Deixe vazio para manter a senha atual">

        <label>Telefone</label>

        <input type="text"
               name="telefone"
               maxlength="20"
               value="<?php echo htmlspecialchars($telefone); ?>">

        <input type="submit" value="Alterar">

    </form>

    <div class="menu">

        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>

            <a href="usuario.php">Voltar</a>

        <?php } else { ?>

            <a href="perfilUsuario.php">Voltar</a>

        <?php } ?>

    </div>

</div>

</body>

</html>