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


$id = $linha['id_usuario'];
$nome = $linha['nome'];
$email = $linha['email'];
$telefone = $linha['telefone'];


?>


<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | Fruit Bubbles</title>
    <link rel="stylesheet" href="styleCLP.css">
</head>


<body>


    <main class="container">


        <section class="perfil">


            <h1>Editar Perfil</h1>
            <p class="mensagem">
                Atualize suas informações pessoais
            </p>


            <form class="informacoes" action="updateUsuario.php" method="post">


                <div class="campo">
                    <span class="titulo">Nome</span>
                    <input type="text"
                           name="nome"
                           maxlength="80"
                           value="<?php echo htmlspecialchars($nome); ?>"
                           required>
                </div>
                <div class="campo">
                    <span class="titulo">Email</span>
                    <input type="email"
                           name="email"
                           maxlength="100"
                           value="<?php echo htmlspecialchars($email); ?>"
                           required>
                </div>


                <div class="campo">
                    <span class="titulo">Telefone</span>
                    <input type="text"
                           name="telefone"
                           maxlength="20"
                           value="<?php echo htmlspecialchars($telefone); ?>">
                </div>
                <div class="campo">
                    <span class="titulo">Nova Senha</span>
                    <input type="password"
                           name="senha"
                           placeholder="Deixe vazio para manter a senha atual">
                </div>


                <div class="botoes">


                    <input class="editar" type="submit" value="Salvar">


                    <a class="sair" href="perfilUsuario.php">Cancelar</a>


                </div>


            </form>


            <div class="botoes">


                <a class="excluir confirmar-exclusao" href="excluirUsuario.php">Excluir Conta</a>


            </div>


        </section>


    </main>


    <script src="script.js"></script>


</body>


</html>