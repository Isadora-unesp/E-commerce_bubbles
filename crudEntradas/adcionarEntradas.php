<?php

include("util.php");

$conn = conecta();

$varSQL = "SELECT id_produto, descricao
           FROM produto
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY descricao";

$select = $conn->query($varSQL);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Adicionar Entrada</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Adicionar Entrada</h2>

    <form action="insertEntradas.php" method="post">

        <label>Produto</label>

        <select name="fk_produto" required>

            <option value="">Selecione um produto</option>

            <?php while ($produto = $select->fetch(PDO::FETCH_ASSOC)) { ?>

                <option value="<?php echo $produto['id_produto']; ?>">
                    <?php echo $produto['descricao']; ?>
                </option>

            <?php } ?>

        </select>

        <label>Quantidade</label>
        <input type="number" name="quantidade" min="1" required>

        <label>Custo Unitário</label>
        <input type="number" step="0.01" min="0" name="custo_unitario" required>

        <label>Observação</label>
        <input type="text" name="obs">

        <br><br>

        <input type="submit" value="Salvar">

    </form>

    <div class="menu">
        <a href="entradas.php">Voltar</a>
    </div>

</div>

</body>

</html>