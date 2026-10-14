<?php
 
include("../util.php");

SaiSeHacker();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="styleCrudProdutos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

    <h2>Adicionar Produto</h2>

    <form action="insertProduto.php" method="post" enctype="multipart/form-data">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Descricao</label>
        <input type="text" name="descricao" required>

        <label>Categoria</label>
        <input type="text" name="categoria">

        <label>Peso (gramas)</label>
        <input type="number" name="peso">

        <label>Fragrancia</label>
        <input type="text" name="fragrancia">

        <label>Valor Unitario</label>
        <input type="number" step="0.01" min="0" name="valor_unitario" required>

        <label>Imagem do produto</label>
        <input
            type="file"
            name="imagem"
            accept="image/jpeg,image/png,image/webp,image/gif"
        >

        <br><br>
        <input type="submit" value="Salvar">
    </form>

    <div class="menu">
        <a href="listarProdutos.php" class="voltar">Voltar</a>
    </div>

</div>

</body>
</html>