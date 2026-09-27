<?php
session_start();

include("util.php");

$conn = conecta();

$varSQL = "SELECT id_produto, nome, descricao, valor_unitario
           FROM produto
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY id_produto";

$select = $conn->query($varSQL);

$produtosBanco = $select->fetchAll(PDO::FETCH_ASSOC);

// Mesmo mapeamento temporário do index.php
$imagensPorId = [
    1 => "img/morango.jpg",
    2 => "img/maracuja.jpg",
    3 => "img/coco.jpg",
    5 => "img/citrico.jpg",
];

$paginaPorId = [
    1 => "produtosIndividuais/sab1.php",
    2 => "produtosIndividuais/sab2.php",
    3 => "produtosIndividuais/sab4.php",
    5 => "produtosIndividuais/sab3.php",
];

$dataNomePorId = [
    1 => "fraguna",
    2 => "passion",
    3 => "coconut",
    5 => "citrico",
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produtos | Fruit Bubbles</title>

    <link rel="stylesheet" href="produto.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <?php include_once "_cabecalho.php"; ?>  

    <main>
 
        <section class="hero-produtos">

            <div class="hero-produtos-texto">

                <h1>
                    Nossa coleção
                    <strong>frutada</strong>
                </h1>

                <p>
                    Descubra sabonetes artesanais feitos com
                    ingredientes naturais e fragrâncias frutadas
                    para transformar seu banho em um momento especial.
                </p>

                <a href="#produtos" class="botao">
                    Explorar produtos
                    <span>↓</span>
                </a>

            </div>


            <div class="hero-produtos-decoracao">

                <div class="bolha bolha1">●</div>
                <div class="bolha bolha2">●</div>
                <div class="bolha bolha3">●</div>

                <div class="fruta fruta1">🍓</div>
                <div class="fruta fruta2">🍊</div>
                <div class="fruta fruta3">🍉</div>

            </div>

        </section>

        <!-- =================================================
             PRODUTOS
        ================================================== -->

        <section class="produtos" id="produtos">

            <div class="titulo-secao-produtos">

                <h2>
                    Nossos produtos
                </h2>

                <p>
                    Sabonetes artesanais para todos os momentos.
                </p>

            </div>
             
            <!-- CARDS -->
 
            <div class="grid-produtos">

                <?php foreach ($produtosBanco as $p): ?>

                    <?php
                        $id = $p['id_produto'];
                        $imagem = $imagensPorId[$id] ?? "img/produto-padrao.jpg";
                        $pagina = $paginaPorId[$id] ?? "#";
                        $dataNome = $dataNomePorId[$id] ?? strtolower($p['nome']);
                    ?>

                    <article class="produto" data-nome="<?= htmlspecialchars($dataNome) ?>">

                        <a href="<?= htmlspecialchars($pagina) ?>" class="link-produto">
                            <div class="produto-imagem">
                                <img
                                    src="<?= htmlspecialchars($imagem) ?>"
                                    alt="Sabonete <?= htmlspecialchars($p['nome']) ?>"
                                >
                            </div>

                            <div class="produto-info">
                                <h3><?= htmlspecialchars($p['nome']) ?></h3>

                                <p class="descricao">
                                    <?= htmlspecialchars($p['descricao']) ?>
                                </p>
                            </div>
                        </a>

                        <div class="produto-final">

                            <strong>
                                R$ <?= number_format($p['valor_unitario'], 2, ',', '.') ?>
                            </strong>

                            <button
                                type="button"
                                class="adicionar"
                                onclick="adicionarCarrinho('<?= htmlspecialchars($p['nome'], ENT_QUOTES) ?>', this)"
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </section>
 
    </main>
 
    <div id="toast" class="toast">

        <span id="toast-message">
            Produto adicionado ao carrinho!
        </span>

    </div>

    <?php include_once "_footer.php"; ?>
 
    <script src="script.js" defer></script>  

</body>
</html>