<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel Administrativo</title>

    <link rel="stylesheet" href="crudUsuarios/styleCrudUsuarios.css">

</head>

<body>

    <main class="container admin-container">

        <section class="admin-opcoes">

            <!-- Usuários -->

            <a href="crudUsuarios/listarUsuario.php" class="admin-bloco">


                <div class="admin-conteudo">

                    <h2>Usuários</h2>

                    <p>
                        Visualizar, alterar e excluir usuários.
                    </p>

                </div>

            </a>

            <!-- Produtos -->

            <a href="crudProdutos/listarProdutos.php" class="admin-bloco">

                <div class="admin-conteudo">

                    <h2>Produtos</h2>

                    <p>
                        Visualizar e gerenciar os produtos cadastrados.
                    </p>

                </div>

            </a>

            <!-- Entradas -->

            <a href="crudEntradas/listarEntradas.php" class="admin-bloco">

                <div class="admin-conteudo">

                    <h2>Entradas</h2>
                    <p>
                        Visualizar e gerenciar as entradas cadastradas.
                    </p>

                </div>

            </a>

        </section>


        <footer class="menu">

            <a href="index.php" class="btn">
                Voltar
            </a>
            <a href="logout.php" class="btn">
                Logout
            </a>

        </footer>

    </main>

</body>

</html>