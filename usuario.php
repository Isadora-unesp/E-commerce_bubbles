<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}

include("util.php");

$conn = conecta();

$varSQL = "SELECT *
           FROM usuario
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY id_usuario";

$select = $conn->query($varSQL);

$usuarios = $select->fetchAll(PDO::FETCH_ASSOC);

$total = count($usuarios);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container grande">

    <h2>Lista de Usuários</h2>

    <div class="total">
        Total de usuários: <?php echo $total; ?>
    </div>

    <table>

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>

        <?php if ($total > 0) { ?>

            <?php foreach ($usuarios as $linha) { ?>

                <tr>

                    <td><?php echo $linha['id_usuario']; ?></td>

                    <td>
                        <?php echo htmlspecialchars($linha['nome']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($linha['email']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($linha['telefone']); ?>
                    </td>

                    <td>

                        <?php
                        if ($linha['admin']) {
                            echo "Sim";
                        } else {
                            echo "Não";
                        }
                        ?>

                    </td>

                    <td>

                        <a href="alterarUsuario.php?id=<?php echo $linha['id_usuario']; ?>">
                            Alterar
                        </a>

                        <?php if (!$linha['admin']) { ?>

                            <a href="excluirUsuario.php?id=<?php echo $linha['id_usuario']; ?>"
                               onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                Excluir
                            </a>

                        <?php } ?>

                    </td>

                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="6">
                    Nenhum usuário cadastrado.
                </td>
            </tr>

        <?php } ?>

    </table>

    <div class="menu">

        <a href="logout.php">
            Sair
        </a>

    </div>

</div>

</body>

</html>