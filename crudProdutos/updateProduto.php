<?php
 
include("../util.php");

SaiSeHacker();

require_once __DIR__ . "/uploadImagem.php";

$conn = conecta();

$caminhoBanco = salvarImagemProduto($_FILES['imagem'] ?? null);

$varSQL = "UPDATE produto 
           SET 
               nome = :nome,
               descricao = :descricao,
               categoria = :categoria,
               peso = :peso,
               fragrancia = :fragrancia,
               valor_unitario = :valor_unitario,
               imagem = COALESCE(:imagem, imagem)
           WHERE id_produto = :id";

$update = $conn->prepare($varSQL);

$update->bindParam(':nome', $_POST['nome']);
$update->bindParam(':descricao', $_POST['descricao']);
$update->bindParam(':categoria', $_POST['categoria']);
$update->bindParam(':peso', $_POST['peso']);
$update->bindParam(':fragrancia', $_POST['fragrancia']);
$update->bindParam(':valor_unitario', $_POST['valor_unitario']);
$update->bindValue(':imagem', $caminhoBanco);
$update->bindParam(':id', $_POST['id']);

try {

    $update->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (Throwable $e) {

    echo "Erro ao alterar o produto: " . $e->getMessage();
    exit;

}
?>