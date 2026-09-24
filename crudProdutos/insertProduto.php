<?php
include("../util.php");

session_start();

SaiSeHacker();

if (empty($_POST)) {
    header("Location: adicionarProduto.php");
    exit;
}

try {
    $conn = conecta();

    $varSQL = "INSERT INTO produto 
               (nome, descricao, categoria, peso, fragrancia, valor_unitario, excluido) 
               VALUES 
               (:nome, :descricao, :categoria, :peso, :fragrancia, :valor_unitario, false)";

    $insert = $conn->prepare($varSQL);

    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':descricao', $_POST['descricao']);
    $insert->bindParam(':categoria', $_POST['categoria']);
    $insert->bindParam(':peso', $_POST['peso']);
    $insert->bindParam(':fragrancia', $_POST['fragrancia']);
    $insert->bindParam(':valor_unitario', $_POST['valor_unitario']);

    $insert->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
