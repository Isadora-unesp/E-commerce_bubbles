<?php

include __DIR__ . '/../util.php';

$conn = conecta();

$varSQL = "SELECT entrada.*, produto.descricao
           FROM entrada
           INNER JOIN produto
           ON entrada.fk_produto = produto.id_produto
           ORDER BY entrada.id_entrada";

$select = $conn->query($varSQL);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Entradas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Entradas de Estoque</h1>

    <div class="menu">
        <a href="adicionarEntradas.php">Adicionar Entrada</a>
    </div>

    <br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Custo Unitário</th>
            <th>Data</th>
            <th>Observação</th>
            <th>Ações</th>
        </tr>

        <?php while ($linha = $select->fetch(PDO::FETCH_ASSOC)) { ?>

        <tr>

            <td><?php echo $linha['id_entrada']; ?></td>

            <td><?php echo $linha['descricao']; ?></td>

            <td><?php echo $linha['quantidade']; ?></td>

            <td><?php echo $linha['custo_unitario']; ?></td>

            <td><?php echo $linha['data_entrada']; ?></td>

            <td><?php echo $linha['obs']; ?></td>

            <td>

                <a href="alterarEntradas.php?id=<?php echo $linha['id_entrada']; ?>">
                    Alterar
                </a>

                <a href="excluirEntradas.php?id=<?php echo $linha['id_entrada']; ?>">
                    Excluir
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>

</html>