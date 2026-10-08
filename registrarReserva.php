
<?php

require_once __DIR__ . '/util.php';

header('Content-Type: application/json; charset=utf-8');

function responder($codigo, $dados) {
    http_response_code($codigo);
    echo json_encode($dados);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder(405, ['ok' => false, 'erro' => 'Método não permitido.']);
}

// Confere o login do cliente
if (empty($_SESSION['logado']) || empty($_SESSION['usuario_id'])) {
    responder(401, [
        'ok' => false,
        'erro' => 'Faça login para finalizar a reserva.'
    ]);
}

$dados = json_decode(file_get_contents('php://input'), true);
$itens = $dados['produtos'] ?? [];

if (!is_array($itens) || empty($itens) || count($itens) > 100) {
    responder(400, [
        'ok' => false,
        'erro' => 'Carrinho inválido.'
    ]);
}

try {
    $pdo = conecta();
    $pdo->beginTransaction();

    // Cria a compra com status reservado
    $sql = "INSERT INTO compra
            (status, sessao, fk_usuario)
            VALUES ('reservado', :sessao, :usuario)
            RETURNING id_compra";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':sessao' => session_id(),
        ':usuario' => $_SESSION['usuario_id']
    ]);

    $idCompra = $stmt->fetchColumn();

    // Consulta o preço real no banco
    $buscar = $pdo->prepare(
        "SELECT id_produto, valor_unitario
         FROM produto
         WHERE nome = :nome AND excluido = false"
    );

    $inserir = $pdo->prepare(
        "INSERT INTO compra_produto
         (fk_produto, fk_compra, quantidade, valor_unitario)
         VALUES (:produto, :compra, :quantidade, :valor)"
    );

    // Agrupa produtos repetidos
    $quantidades = [];

    foreach ($itens as $nome) {
        if (!is_string($nome) || trim($nome) === '') {
            throw new Exception('Produto inválido.');
        }

        $quantidades[$nome] =
            ($quantidades[$nome] ?? 0) + 1;
    }

    foreach ($quantidades as $nome => $quantidade) {

        $buscar->execute([':nome' => $nome]);
        $produto = $buscar->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            throw new Exception('Produto não encontrado: ' . $nome);
        }

        $inserir->execute([
            ':produto' => $produto['id_produto'],
            ':compra' => $idCompra,
            ':quantidade' => $quantidade,
            ':valor' => $produto['valor_unitario']
        ]);
    }

    $pdo->commit();

    responder(200, [
        'ok' => true,
        'id' => $idCompra,
        'mensagem' => 'Reserva registrada com sucesso!'
    ]);

} catch (Throwable $erro) {

    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    error_log($erro->getMessage());

    responder(500, [
        'ok' => false,
        'erro' => 'Não foi possível registrar a reserva.'
    ]);
}
