<?php
// Simula um registro bem-sucedido sem acessar o banco.
session_start();

// Valores de teste
$_SESSION['usuario_id'] = 99999;
$_SESSION['logado'] = true;

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'ok' => true,
    'usuario_id' => $_SESSION['usuario_id'],
    'logado' => $_SESSION['logado']
]);

?>
