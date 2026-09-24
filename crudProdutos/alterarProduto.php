<?php

include("../util.php");

$conn = conecta();
$id = $_GET['id'];

$varSQL = "SELECT * FROM produto WHERE id_produto = :id";
$select = $conn->prepare($varSQL);
$select->bindParam(':id', $id);
$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

$id = $linha['id_produto'];
$nome = $linha['nome'];
$descricao = $linha['descricao'];
$categoria = $linha['categoria'];
$peso = $linha['peso'];
$fragrancia = $linha['fragrancia'];
$valor_unitario = $linha['valor_unitario'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alterar Produto</title>
    <link rel="stylesheet" href="styleCrudProdutos.css">
</head>
<body>

<div class="container">

    <h2>Alterar Produto</h2>

    <form action="updateProduto.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>

        <label>Descricao</label>
        <input type="text" name="descricao" value="<?php echo $descricao; ?>" required>

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?php echo $categoria; ?>">

        <label>Peso (gramas)</label>
        <input type="number" name="peso" value="<?php echo $peso; ?>">

        <label>Fragrancia</label>
        <input type="text" name="fragrancia" value="<?php echo $fragrancia; ?>">

        <label>Valor Unitario</label>
        <input type="number" step="0.01" min="0" name="valor_unitario" value="<?php echo $valor_unitario; ?>" required>

        <br><br>
        <input type="submit" value="Alterar">
    </form>

    <div class="menu">
        <a href="listarProdutos.php" class="voltar">Voltar</a>
    </div>

</div>

</body>
</html>