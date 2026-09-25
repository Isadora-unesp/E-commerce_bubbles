<?php

session_start();

include("../util.php");

SaiSeHacker();

if (empty($_POST)) {
    header("Location: adicionarEntradas.php");
    exit;
}

try {

    $conn = conecta();

    $varSQL = "INSERT INTO entrada
               (quantidade, custo_unitario, obs, fk_produto)
               VALUES
               (:quantidade, :custo_unitario, :obs, :fk_produto)";

    $insert = $conn->prepare($varSQL);

    $insert->bindParam(':quantidade', $_POST['quantidade']);
    $insert->bindParam(':custo_unitario', $_POST['custo_unitario']);
    $insert->bindParam(':obs', $_POST['obs']);
    $insert->bindParam(':fk_produto', $_POST['fk_produto']);

    $insert->execute();

    header("Location: listarEntradas.php");
    exit;

} catch (PDOException $e) {

    echo "Erro: " . $e->getMessage();

}

?>