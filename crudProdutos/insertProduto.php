<?php
 
include("../util.php");

SaiSeHacker();

require_once __DIR__ . "/uploadImagem.php";

if (empty($_POST)) {
    header("Location: adicionarProduto.php");
    exit;
}

try {
    $conn = conecta(); 

    $caminhoBanco = salvarImagemProduto($_FILES['imagem'] ?? null) ?? '';

    $varSQL = "INSERT INTO produto 
               (nome, descricao, categoria, peso, fragrancia, valor_unitario, imagem, excluido) 
               VALUES 
               (:nome, :descricao, :categoria, :peso, :fragrancia, :valor_unitario, :imagem, false)";

    $insert = $conn->prepare($varSQL);

    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':descricao', $_POST['descricao']);
    $insert->bindParam(':categoria', $_POST['categoria']);
    $insert->bindParam(':peso', $_POST['peso']);
    $insert->bindParam(':fragrancia', $_POST['fragrancia']);
    $insert->bindParam(':valor_unitario', $_POST['valor_unitario']);
    $insert->bindValue(':imagem', $caminhoBanco);
    
    $insert->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (Throwable $e) {
    echo "Erro: " . $e->getMessage();
}
?>
