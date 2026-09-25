<?php
session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

$varSQL = "SELECT * FROM produto WHERE (excluido = false OR excluido IS NULL) ORDER BY id_produto";
$select = $conn->query($varSQL);
$total = $select->rowCount();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="styleCrudProdutos.css">
</head>
<body>

<div class="container">

    <h2>Lista de Produtos</h2>

    <div class="total">Total: <?php echo $total; ?></div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Categoria</th>
            <th>Peso</th>
            <th>Fragrancia</th>
            <th>Valor</th>
            <th>Acoes</th>
        </tr>

        <?php
        $tem = false;
        while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
            $tem = true;
            $id = $linha["id_produto"];
            ?>
            <tr>
                <td><?php echo $linha["id_produto"]; ?></td>
                <td><?php echo $linha["nome"]; ?></td>
                <td><?php echo $linha["descricao"]; ?></td>
                <td><?php echo $linha["categoria"]; ?></td>
                <td><?php echo $linha["peso"]; ?>g</td>
                <td><?php echo $linha["fragrancia"]; ?></td>
                <td>R$ <?php echo number_format($linha["valor_unitario"], 2, ",", "."); ?></td>
                <td>
                    <a href="alterarProduto.php?id=<?php echo $id; ?>">Alterar</a>
                    <a href="excluirProduto.php?id=<?php echo $id; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php
        }
        if (!$tem) {
            echo "<tr><td colspan='8'>Nenhum produto cadastrado</td></tr>";
        }
        ?>
    </table>

    <div class="menu">
        <br>
        <a href="adicionarProduto.php">Adicionar Produto</a>
    </div>
    <div class="menu">
        <a href="../admin.php" class="voltar">Voltar</a>
    </div>

</div>

</body>
</html>