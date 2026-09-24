<?php

include("util.php");

$conn = conecta();

$id = $_GET['id'];

$varSQL = "SELECT *
           FROM entrada
           WHERE id_entrada = :id";

$select = $conn->prepare($varSQL);
$select->bindParam(':id', $id);
$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

$id = $linha['id_entrada'];
$quantidade = $linha['quantidade'];
$custo_unitario = $linha['custo_unitario'];
$obs = $linha['obs'];
$fk_produto = $linha['fk_produto'];

$varSQLProdutos = "SELECT id_produto, descricao
                   FROM produto
                   WHERE (excluido = false OR excluido IS NULL)
                   ORDER BY descricao";

$selectProdutos = $conn->query($varSQLProdutos);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Alterar Entrada</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Alterar Entrada</h2>

    <form action="updateEntradas.php" method="post">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Produto</label>

        <select name="fk_produto" required>

            <?php while ($produto = $selectProdutos->fetch(PDO::FETCH_ASSOC)) { ?>

                <option
                    value="<?php echo $produto['id_produto']; ?>"
                    <?php if ($produto['id_produto'] == $fk_produto) echo "selected"; ?>
                >
                    <?php echo $produto['descricao']; ?>
                </option>

            <?php } ?>

        </select>

        <label>Quantidade</label>
        <input
            type="number"
            name="quantidade"
            value="<?php echo $quantidade; ?>"
            min="1"
            required
        >

        <label>Custo Unitário</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="custo_unitario"
            value="<?php echo $custo_unitario; ?>"
            required
        >

        <label>Observação</label>
        <input
            type="text"
            name="obs"
            value="<?php echo $obs; ?>"
        >

        <br><br>

        <input type="submit" value="Alterar">

    </form>

    <div class="menu">
        <a href="entradas.php">Voltar</a>
    </div>

</div>

</body>

</html>