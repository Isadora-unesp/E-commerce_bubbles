<?php
// Carrega as funções utilitárias do sistema
require_once "../util.php";

$base = "../";

$conn = conecta();

$idProduto = 3; // id_produto no banco (Sabonete de Coco)

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

// Mapeamento temporário de imagem/página por id_produto (mesmo usado no index.php/produtos.php)
$imagensPorId = [
    1 => "../img/morango.jpg",
    2 => "../img/maracuja.jpg",
    3 => "../img/coco.jpg",
    5 => "../img/citrico.jpg",
];

$paginaPorId = [
    1 => "sab1.php",
    2 => "sab2.php",
    3 => "sab4.php",
    5 => "sab3.php",
];

// Busca os outros produtos ativos (pra seção "Conheça nossos outros sabonetes")
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sabonete <?= htmlspecialchars($produto['nome']) ?> | Fruit Bubbles</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="styleSAB.css">
</head>

<body>

    <!-- INCLUSÃO DO CABEÇALHO EM PHP -->
    <?php include_once "../_cabecalho.php"; ?>
 
    <!-- CONTEÚDO PRINCIPAL -->
    <main class="pagina-produto">

        <!-- CAMINHO DA PÁGINA -->
        <nav class="caminho" aria-label="Você está em">

            <a href="../index.php">Início</a>

            <span>/</span>

            <a href="../produtos.php">Produtos</a>

            <span>/</span>

            <span><?= htmlspecialchars($produto['nome']) ?></span>

        </nav>


        <!-- DETALHES DO PRODUTO -->
        <section class="detalhe">

            <!-- CARROSSEL DE FOTOS -->
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


                <!-- PONTOS DO CARROSSEL -->
                <div class="pontos">
                    <button type="button" class="ponto ativo" aria-label="Foto 1"></button>
                    <button type="button" class="ponto" aria-label="Foto 2"></button>
                    <button type="button" class="ponto" aria-label="Foto 3"></button>
                </div>

            </div>


            <!-- INFORMAÇÕES DO PRODUTO -->
            <div class="detalhe-info">

                <div>

                    <span class="subtitulo">SABONETE MASSAGEADOR ARTESANAL</span>

                    <h1><?= htmlspecialchars($produto['nome']) ?></h1>

                    <p class="resumo">
                        <?= htmlspecialchars($produto['descricao']) ?>
                    </p>

                </div>


                <!-- BENEFÍCIOS -->
                <ul class="beneficios">
                    <li>Ingredientes naturais</li>
                    <li>Não testado em animais</li>
                    <li>Vegano</li>
                    <li>Hidratação natural</li>
                </ul>


                <!-- PREÇO -->
                <p class="preco">R$ <?= number_format($produto['valor_unitario'], 2, ',', '.') ?></p>


                <!-- PESO -->
                <div class="bloco-opcao">

                    <span>Peso</span>

                    <button type="button" class="peso-btn"><?= htmlspecialchars($produto['peso']) ?> g</button>

                </div>


                <!-- QUANTIDADE -->
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


                <!-- ADICIONAR AO CARRINHO -->
                <button
                    type="button"
                    class="comprar"
                    id="botaoComprar">

                    Adicionar ao carrinho

                </button>


            </div>

        </section>


        <!-- DESCRIÇÃO -->
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


        <!-- OUTROS SABONETES (não inclui o produto desta página) -->
        <section class="outros">

            <div class="titulo-secao">

                <h2>Conheça nossos outros sabonetes</h2>

            </div>


            <div class="outros-grade">

                <?php foreach ($outrosProdutos as $outro): ?>

                    <a href="<?= htmlspecialchars($paginaPorId[$outro['id_produto']] ?? '#') ?>" class="outro-card">
                        <img src="<?= htmlspecialchars($imagensPorId[$outro['id_produto']] ?? '../img/produto-padrao.jpg') ?>" alt="Sabonete <?= htmlspecialchars($outro['nome']) ?>">
                        <h3><?= htmlspecialchars($outro['nome']) ?></h3>
                        <strong>R$ <?= number_format($outro['valor_unitario'], 2, ',', '.') ?></strong>
                    </a>

                <?php endforeach; ?>

            </div>

        </section>

    </main>
 
    <?php include_once "../_footer.php"; ?>
 
    <script src="../script.js" defer></script>

</body>

</html>