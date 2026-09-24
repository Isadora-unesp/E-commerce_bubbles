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
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Usuários</title>

    <link rel="stylesheet" href="styleCRUD.css">

</head>

<body>

    <main class="container grande">

        <header class="pagina-header">

            <div>

                <h1>Lista de Usuários</h1>

                <p class="total">
                    Total de usuários:
                    <strong><?php echo $total; ?></strong>
                </p>

            </div>

        </header>


        <section class="tabela-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Admin</th>
                        <th>Ações</th>
                    </tr>

                </thead>


                <tbody>

                    <?php if ($total > 0) { ?>

                        <?php foreach ($usuarios as $linha) { ?>

                            <tr>

                                <td class="id">
                                    <?php echo $linha['id_usuario']; ?>
                                </td>


                                <td class="nome">
                                    <?php echo htmlspecialchars($linha['nome']); ?>
                                </td>


                                <td>
                                    <?php echo htmlspecialchars($linha['email']); ?>
                                </td>


                                <td>
                                    <?php echo htmlspecialchars($linha['telefone']); ?>
                                </td>


                                <td>

                                    <?php if ($linha['admin']) { ?>

                                        <span class="badge admin">
                                            Sim
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge usuario">
                                            Não
                                        </span>

                                    <?php } ?>

                                </td>


                                <td class="acoes">

                                    <a
                                        class="btn-alterar"
                                        href="alterarUsuario.php?id=<?php echo $linha['id_usuario']; ?>"
                                    >
                                        Alterar
                                    </a>


                                    <?php if (!$linha['admin']) { ?>

                                        <a
                                            class="btn-excluir"
                                            href="excluirUsuario.php?id=<?php echo $linha['id_usuario']; ?>"
                                            onclick="return confirm('Tem certeza que deseja excluir este usuário?')"
                                        >
                                            Excluir
                                        </a>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <tr>

                            <td colspan="6" class="nenhum-usuario">
                                Nenhum usuário cadastrado.
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </section>


        <footer class="menu">

            <a href="index.php" class="btn">
                Sair
            </a>

        </footer>

    </main>

</body>

</html>