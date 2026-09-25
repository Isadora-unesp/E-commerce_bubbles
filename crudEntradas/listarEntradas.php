<?php

session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

$varSQL = "SELECT entrada.*, produto.descricao
           FROM entrada
           INNER JOIN produto
           ON entrada.fk_produto = produto.id_produto
           ORDER BY entrada.id_entrada";

$select = $conn->query($varSQL);

$entradas = $select->fetchAll(PDO::FETCH_ASSOC);

$total = count($entradas);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entradas de Estoque</title>

    <link rel="stylesheet" href="styleCrudEntradas.css">

</head>

<body>

    <main class="container grande">

        <header class="pagina-header">

            <div>

                <h1>Entradas de Estoque</h1>

                <p class="total">
                    Total de entradas:
                    <strong><?php echo $total; ?></strong>
                </p>

            </div>

        </header>


        <div class="menu" style="justify-content: flex-start; margin-bottom: 20px;">
            <a href="adicionarEntradas.php" class="btn">
                Adicionar Entrada
            </a>
        </div>


        <section class="tabela-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Custo Unitário</th>
                        <th>Data</th>
                        <th>Observação</th>
                        <th>Ações</th>
                    </tr>

                </thead>


                <tbody>

                    <?php if ($total > 0) { ?>

                        <?php foreach ($entradas as $linha) { ?>

                            <tr>

                                <td class="id">
                                    <?php echo $linha['id_entrada']; ?>
                                </td>

                                <td class="nome">
                                    <?php echo htmlspecialchars($linha['descricao']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($linha['quantidade']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($linha['custo_unitario']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($linha['data_entrada']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($linha['obs'] ?? ''); ?>
                                </td>

                                <td class="acoes">

                                    <a
                                        class="btn-alterar"
                                        href="alterarEntradas.php?id=<?php echo $linha['id_entrada']; ?>"
                                    >
                                        Alterar
                                    </a>

                                    <a
                                        class="btn-excluir"
                                        href="excluirEntradas.php?id=<?php echo $linha['id_entrada']; ?>"
                                        onclick="return confirm('Tem certeza que deseja excluir esta entrada?')"
                                    >
                                        Excluir
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <tr>

                            <td colspan="7" class="nenhum-usuario">
                                Nenhuma entrada cadastrada.
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </section>


        <footer class="menu">

            <a href="../admin.php" class="btn">
                Voltar
            </a>

        </footer>

    </main>

</body>

</html>