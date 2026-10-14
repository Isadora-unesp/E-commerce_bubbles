
<?php

include("util.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$conn = conecta();

$id = $_SESSION['usuario_id'];

$varSQL = "SELECT *
           FROM usuario
           WHERE id_usuario = :id
           AND (excluido = false OR excluido IS NULL)";

$select = $conn->prepare($varSQL);
$select->bindParam(':id', $id);
$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

if (!$linha) {
    echo "Usuário não encontrado.";
    exit;
}

$nome = $linha['nome'];
$email = $linha['email'];
$telefone = $linha['telefone'];
$fotoPerfil = $linha['foto_perfil'] ?? null;

// Busca as reservas do usuário conectado
$consultaPedidos = $conn->prepare("
    SELECT
        c.id_compra,
        c.status,
        cp.quantidade,
        cp.valor_unitario,
        p.nome AS produto
    FROM compra c
    INNER JOIN compra_produto cp
        ON cp.fk_compra = c.id_compra
    INNER JOIN produto p
        ON p.id_produto = cp.fk_produto
    WHERE c.fk_usuario = :usuario
    ORDER BY c.id_compra DESC, p.nome
");

$consultaPedidos->execute([
    ':usuario' => $id
]);

$pedidos = [];

foreach ($consultaPedidos->fetchAll(PDO::FETCH_ASSOC) as $item) {

    $numero = $item['id_compra'];

    if (!isset($pedidos[$numero])) {
        $pedidos[$numero] = [
            'status' => $item['status'],
            'itens' => [],
            'total' => 0
        ];
    }

    $pedidos[$numero]['itens'][] = $item;

    $pedidos[$numero]['total'] +=
        $item['quantidade'] * $item['valor_unitario'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu Perfil | Fruit Bubbles</title>

    <link rel="stylesheet" href="styleCLP.css">
</head>

<body>

    <a href="index.php" class="voltar-index"
       aria-label="Voltar para a página inicial">
        <span>←</span> Voltar
    </a>

    <main class="container">

        <section class="perfil">

            <div class="foto-perfil-container">

                <?php if (!empty($fotoPerfil)) { ?>

                    <img
                        src="<?php echo htmlspecialchars($fotoPerfil, ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Foto de perfil de <?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>"
                        class="foto-perfil"
                    >

                <?php } else { ?>

                    <img
                        src="https://placehold.co/120x120/fff2e8/46220f?text=FB"
                        alt="Foto padrão do perfil"
                        class="foto-perfil"
                    >

                <?php } ?>

            </div>

            <h1>Meu Perfil</h1>

            <p class="mensagem">
                Veja suas informações pessoais
            </p>

            <div class="informacoes">

                <div class="campo">
                    <span class="titulo">Nome</span>
                    <p><?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>

                <div class="campo">
                    <span class="titulo">Email</span>
                    <p><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>

                <div class="campo">
                    <span class="titulo">Telefone</span>
                    <p><?php echo htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>

            </div>

            <div class="botoes">

                <a class="editar" href="crudUsuarios/editarPerfil.php">
                    Editar Perfil
                </a>

                <a class="sair" href="logout.php">
                    Sair
                </a>

            </div>

        </section>

        <section class="meus-pedidos" id="meus-pedidos">

            <h2>Meus pedidos</h2>

            <p>
                Acompanhe suas reservas e confira
                os produtos escolhidos.
            </p>

            <?php if (empty($pedidos)): ?>

                <p class="pedidos-vazios">
                    Você ainda não realizou nenhuma reserva.
                </p>

            <?php else: ?>

                <?php foreach ($pedidos as $numero => $pedido): ?>

                    <article class="pedido-card">

                        <div class="pedido-topo">

                            <strong>
                                Reserva #<?= (int)$numero ?>
                            </strong>

                            <span class="pedido-status">
                                <?= htmlspecialchars(
                                    ucfirst($pedido['status']),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </span>

                        </div>

                        <h3>Produtos reservados</h3>

                        <ul>

                            <?php foreach ($pedido['itens'] as $item): ?>

                                <li>
                                    <?= htmlspecialchars(
                                        $item['produto'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                    —
                                    <?= (int)$item['quantidade'] ?> x

                                    R$
                                    <?= number_format(
                                        (float)$item['valor_unitario'],
                                        2,
                                        ',',
                                        '.'
                                    ) ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                        <strong class="pedido-total">
                            Total: R$
                            <?= number_format(
                                $pedido['total'],
                                2,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <p class="pedido-retirada">
                            Retirada: consulte o local e horário
                            informados pela loja.
                        </p>

                    </article>

                <?php endforeach; ?>

            <?php endif; ?>

        </section>

    </main>

</body>

</html>
