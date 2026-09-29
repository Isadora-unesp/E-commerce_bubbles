<?php

require_once "../util.php";

$base = $base ?? "";
 
$conn = conecta();

$idProduto = 5; 

$varSQL = "SELECT nome, peso, valor_unitario, descricao
           FROM produto
           WHERE id_produto = :id
           AND (excluido = false OR excluido IS NULL)";

$select = $conn->prepare($varSQL);
$select->bindParam(':id', $idProduto);
$select->execute();

$produto = $select->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

$imagensPorId = [
    1 => "img/morango.jpg",
    2 => "img/maracuja.jpg",
    3 => "img/coco.jpg",
    5 => "img/citrico.jpg",
];

$paginaPorId = [
    1 => "sab1.php",
    2 => "sab2.php",
    3 => "sab4.php",
    5 => "sab3.php",
];

$varSQLOutros = "SELECT id_produto, nome, valor_unitario
                 FROM produto
                 WHERE id_produto != :id
                 AND (excluido = false OR excluido IS NULL)
                 ORDER BY id_produto";

$selectOutros = $conn->prepare($varSQLOutros);
$selectOutros->bindParam(':id', $idProduto);
$selectOutros->execute();

$outrosProdutos = $selectOutros->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <base href="<?= $_SESSION['raiz'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sabonete <?= htmlspecialchars($produto['nome']) ?> | Fruit Bubbles</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="produtosIndividuais/styleSAB.css">
</head>

<body>

    <?php include_once "../_cabecalho.php"; ?>
 
    <main class="pagina-produto">

        <nav class="caminho" aria-label="Você está em">

            <a href="index.php">Início</a>

            <span>/</span>

            <a href="produtos.php">Produtos</a>

            <span>/</span>

            <span><?= htmlspecialchars($produto['nome']) ?></span>

        </nav>

        <section class="detalhe">

            <div class="slideshow-coluna">

                <div class="slideshow">

                    <div class="slide ativo">
                        <span class="slide-contador">1 / 3</span>
                        <img src="<?= htmlspecialchars($imagensPorId[$idProduto]) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>, foto 1">
                    </div>

                    <div class="slide">
                        <span class="slide-contador">2 / 3</span>
                        <img src="<?= htmlspecialchars($imagensPorId[$idProduto]) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>, foto 2">
                    </div>

                    <div class="slide">
                        <span class="slide-contador">3 / 3</span>
                        <img src="<?= htmlspecialchars($imagensPorId[$idProduto]) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>, foto 3">
                    </div>

                    <button type="button" class="seta-slide anterior" id="slideAnterior" aria-label="Foto anterior">
                        &#10094;
                    </button>

                    <button type="button" class="seta-slide proximo" id="slideProximo" aria-label="Próxima foto">
                        &#10095;
                    </button>

                </div>

                <div class="pontos">
                    <button type="button" class="ponto ativo" aria-label="Foto 1"></button>
                    <button type="button" class="ponto" aria-label="Foto 2"></button>
                    <button type="button" class="ponto" aria-label="Foto 3"></button>
                </div>

            </div>

            <div class="detalhe-info">

                <div>

                    <span class="subtitulo">SABONETE ARTESANAL</span>

                    <h1><?= htmlspecialchars($produto['nome']) ?></h1>

                    <p class="resumo">
                        <?= htmlspecialchars($produto['descricao']) ?>
                    </p>

                </div>

                <ul class="beneficios">
                    <li>Ingredientes naturais</li>
                    <li>Não testado em animais</li>
                    <li>Vegano</li>
                    <li>Hidratação natural</li>
                </ul>

                <p class="preco">R$ <?= number_format($produto['valor_unitario'], 2, ',', '.') ?></p>

                <div class="bloco-opcao">

                    <span>Peso</span>

                    <button type="button" class="peso-btn"><?= htmlspecialchars($produto['peso']) ?> g</button>

                </div>

                <div class="bloco-opcao">

                    <span>Quantidade</span>

                    <div class="quantidade">

                        <button
                            type="button"
                            id="menosQtd"
                            aria-label="Diminuir quantidade">
                            −
                        </button>

                        <span id="qtdValor">1</span>

                        <button
                            type="button"
                            id="maisQtd"
                            aria-label="Aumentar quantidade">
                            +
                        </button>

                    </div>

                </div>

                <button
                    type="button"
                    class="comprar"
                    id="botaoComprar">

                    Adicionar ao carrinho

                </button>

            </div>

        </section>

        <section class="info-card">

            <div class="coluna">

                <h2>Descrição do produto</h2>

                <p>
                    <?= htmlspecialchars($produto['descricao']) ?>
                </p>

            </div>

            <div class="coluna">

                <h2>Modo de uso</h2>

                <p>
                    Umedeça o sabonete e a pele. Massageie suavemente até formar espuma.
                    Enxágue em seguida. Uso diário.
                </p>

                <h2>Ingredientes</h2>

                <p>
                    Base vegetal, óleo de coco, óleo de palma, extrato natural de frutas vermelhas,
                    manteiga de karité, glicerina vegetal, fragrância natural e vitamina E.
                </p>

            </div>

        </section>

        <section class="outros">

            <div class="titulo-secao">

                <h2>Conheça nossos outros sabonetes</h2>

            </div>

            <div class="outros-grade">

                <?php foreach ($outrosProdutos as $outro): ?>

                    <a href="<?= htmlspecialchars($paginaPorId[$outro['id_produto']] ?? '#') ?>" class="outro-card">
                        <img src="<?= htmlspecialchars($imagensPorId[$outro['id_produto']] ?? 'img/logo.png') ?>" alt="Sabonete <?= htmlspecialchars($outro['nome']) ?>">
                        <h3><?= htmlspecialchars($outro['nome']) ?></h3>
                        <strong>R$ <?= number_format($outro['valor_unitario'], 2, ',', '.') ?></strong>
                    </a>

                <?php endforeach; ?>

            </div>

        </section>

    </main>
 
    <?php include_once "../_footer.php"; ?>
 
    <script src="script.js" defer></script>

</body>

</html>