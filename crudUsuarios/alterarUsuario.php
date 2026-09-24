<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: usuario.php");
    exit;
}

include("../util.php");

$conn = conecta();

$id = $_GET['id'];

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
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alterar Usuário</title>

    <link rel="stylesheet" href="styleCrudUsuarios.css">

</head>

<body>

    <main class="container">

        <header class="pagina-header">

            <h1>Alterar Usuário</h1>

            <p>
                Altere os dados do usuário abaixo.
            </p>

        </header>


        <form
            class="formulario"
            action="updateUsuario.php"
            method="post"
        >

            <input
                type="hidden"
                name="id"
                value="<?php echo htmlspecialchars($id); ?>"
            >


            <div class="campo">

                <label for="nome">
                    Nome
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    maxlength="80"
                    value="<?php echo htmlspecialchars($nome); ?>"
                    required
                >

            </div>


            <div class="campo">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="100"
                    value="<?php echo htmlspecialchars($email); ?>"
                    required
                >

            </div>


            <div class="campo">

                <label for="senha">
                    Nova Senha
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Deixe vazio para manter a senha atual"
                >

                <small>
                    Preencha somente se quiser alterar a senha.
                </small>

            </div>


            <div class="campo">

                <label for="telefone">
                    Telefone
                </label>

                <input
                    type="text"
                    id="telefone"
                    name="telefone"
                    maxlength="20"
                    value="<?php echo htmlspecialchars($telefone); ?>"
                >

            </div>


            <div class="acoes-formulario">

                <a
                    href="../admin.php"
                    class="btn"
                >
                    Voltar
                </a>

                <button
                    type="submit"
                    class="btn-alterar"
                >
                    Alterar
                </button>

            </div>

        </form>

    </main>

</body>

</html>