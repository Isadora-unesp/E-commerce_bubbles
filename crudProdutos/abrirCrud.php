<?php

include("../util.php");

$conn = conecta();

$varSQL = "SELECT COUNT(*) as total FROM produto WHERE (excluido = false OR excluido IS NULL)";
$select = $conn->query($varSQL);
$total = $select->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Produtos</title>
    <link rel="stylesheet" href="styleCrudProdutos.css">
</head>
<body>

<div class="container">

    <h1>Sistema de Produtos</h1>

    <div class="menu">
        <a href="listarProdutos.php">Listar</a>
        <a href="adicionarProduto.php">Adicionar</a>
    </div>

    <div class="total">Total de produtos ativos: <?php echo $total['total']; ?></div>

</div>

</body>
</html>