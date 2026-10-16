<?php

include("../util.php");

// só o administrador entra (redireciona para ../index.php)
SaiSeHacker();

$conn = conecta();

// ------------------------------------------------------------
// Filtros (GET, assim dá para recarregar a página sem reenviar)
// ------------------------------------------------------------
function dataValida($texto, $padrao)
{
    $d = DateTime::createFromFormat('Y-m-d', (string) $texto);
    return ($d && $d->format('Y-m-d') === $texto) ? $texto : $padrao;
}

$enviado = isset($_GET['datai']) || isset($_GET['dataf']);

$datai = dataValida($_GET['datai'] ?? '', date('Y-m-01')); // 1º dia do mês
$dataf = dataValida($_GET['dataf'] ?? '', date('Y-m-d'));  // hoje

if ($datai > $dataf) {
    [$datai, $dataf] = [$dataf, $datai];
}

// na 1ª visita a caixa vem marcada; depois respeita o que foi enviado
$omitirCancelados = $enviado ? isset($_GET['cancelados']) : true;

// ------------------------------------------------------------
// Busca compras + itens em uma única consulta
// ------------------------------------------------------------
$sql = "SELECT c.id_compra,
               c.status::text AS status,
               c.data,
               u.nome AS cliente,
               p.nome AS produto,
               cp.quantidade,
               cp.valor_unitario
        FROM compra c
        LEFT JOIN usuario u ON u.id_usuario = c.fk_usuario
        LEFT JOIN compra_produto cp ON cp.fk_compra = c.id_compra
        LEFT JOIN produto p ON p.id_produto = cp.fk_produto
        WHERE c.data::date BETWEEN :datai AND :dataf "
        . ($omitirCancelados ? " AND LOWER(c.status::text) <> 'cancelado' " : "") .
       "ORDER BY c.data DESC, c.id_compra DESC, p.nome";

$select = $conn->prepare($sql);
$select->execute([':datai' => $datai, ':dataf' => $dataf]);

// agrupa as linhas por compra
$compras = [];

while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {

    $id = $linha['id_compra'];

    if (!isset($compras[$id])) {
        $compras[$id] = [
            'status'  => $linha['status'],
            'data'    => $linha['data'],
            'cliente' => $linha['cliente'],
            'itens'   => [],
            'total'   => 0
        ];
    }

    if ($linha['produto'] !== null) {
        $sub = $linha['valor_unitario'] * $linha['quantidade'];

        $compras[$id]['itens'][] = [
            'produto'  => $linha['produto'],
            'qtd'      => $linha['quantidade'],
            'unitario' => $linha['valor_unitario'],
            'sub'      => $sub
        ];

        $compras[$id]['total'] += $sub;
    }
}

// resumo (o faturamento nunca conta as compras canceladas)
$qtdCompras = count($compras);
$faturamento = 0;

foreach ($compras as $c) {
    if (strtolower($c['status']) !== 'cancelado') {
        $faturamento += $c['total'];
    }
}

function dinheiro($v)
{
    return 'R$ ' . number_format((float) $v, 2, ',', '.');
}

function h($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitor de Vendas</title>

    <link rel="stylesheet" href="styleCrudVendas.css">

</head>

<body>

    <main class="container grande">

        <header class="pagina-header">

            <h1>Monitor de Vendas</h1>

            <p class="total">
                Período de
                <strong><?= date('d/m/Y', strtotime($datai)) ?></strong>
                a
                <strong><?= date('d/m/Y', strtotime($dataf)) ?></strong>
            </p>

        </header>


        <form class="filtro" method="get" action="">

            <div class="campo">
                <label for="datai">Data inicial</label>
                <input type="date" id="datai" name="datai"
                       value="<?= h($datai) ?>">
            </div>

            <div class="campo">
                <label for="dataf">Data final</label>
                <input type="date" id="dataf" name="dataf"
                       value="<?= h($dataf) ?>">
            </div>

            <label class="check">
                <input type="checkbox" name="cancelados" value="1"
                       <?= $omitirCancelados ? 'checked' : '' ?>>
                Omitir cancelados
            </label>

            <input type="submit" value="Filtrar">

        </form>


        <section class="resumo">

            <div class="resumo-item">
                <span>Compras no período</span>
                <strong><?= $qtdCompras ?></strong>
            </div>

            <div class="resumo-item">
                <span>Faturamento (sem cancelados)</span>
                <strong><?= dinheiro($faturamento) ?></strong>
            </div>

        </section>


        <?php if ($qtdCompras > 0) { ?>

            <?php foreach ($compras as $id => $c) { ?>

                <section class="compra">

                    <div class="compra-cabecalho">

                        <div>
                            <span class="compra-id">Compra #<?= h($id) ?></span>
                            <span class="compra-data">
                                <?= date('d/m/Y', strtotime($c['data'])) ?>
                            </span>
                        </div>

                        <div class="compra-cliente">
                            <?= $c['cliente'] !== null
                                ? h($c['cliente'])
                                : 'Cliente não identificado' ?>
                        </div>

                        <span class="status status-<?= h(strtolower($c['status'])) ?>">
                            <?= h($c['status']) ?>
                        </span>

                    </div>

                    <div class="tabela-container">

                        <table>

                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th class="num">Qtd</th>
                                    <th class="num">Valor unit.</th>
                                    <th class="num">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (count($c['itens']) > 0) { ?>

                                    <?php foreach ($c['itens'] as $item) { ?>
                                        <tr>
                                            <td class="nome"><?= h($item['produto']) ?></td>
                                            <td class="num"><?= h($item['qtd']) ?></td>
                                            <td class="num"><?= dinheiro($item['unitario']) ?></td>
                                            <td class="num"><?= dinheiro($item['sub']) ?></td>
                                        </tr>
                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="4" class="nenhum">
                                            Compra sem itens.
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="3" class="num">Total da compra</td>
                                    <td class="num"><?= dinheiro($c['total']) ?></td>
                                </tr>
                            </tfoot>

                        </table>

                    </div>

                </section>

            <?php } ?>

        <?php } else { ?>

            <p class="vazio">Nenhuma compra encontrada neste período.</p>

        <?php } ?>


        <footer class="menu">
            <a href="../admin.php" class="btn">Voltar</a>
        </footer>

    </main>

</body>

</html>