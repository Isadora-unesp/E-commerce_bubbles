<?php
 
include("util.php");

$conn = conecta();

// Consulta para obter os produtos disponíveis
$varSQL = "SELECT id_produto, nome, descricao, valor_unitario, imagem
           FROM produto
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY id_produto";

$select = $conn->query($varSQL);

$produtosBanco = $select->fetchAll(PDO::FETCH_ASSOC);

// Mapeamento de imagens, páginas e nomes para produtos específicos
$imagensPorId = [
    12 => "img/morango.jpg",
    2 => "img/maracuja.jpg",
    3 => "img/coco.jpg",
    5 => "img/citrico.jpg",
];

// Mapeamento de páginas e nomes para produtos específicos
$paginaPorId = [
    12 => "produtosIndividuais/sab1.php",
    2 => "produtosIndividuais/sab2.php",
    3 => "produtosIndividuais/sab4.php",
    5 => "produtosIndividuais/sab3.php",
];

// Mapeamento de nomes para produtos específicos
$dataNomePorId = [
    12 => "melancia",
    2 => "maracujá",
    3 => "coco",
    5 => "citrico",
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <base href="<?= $_SESSION['raiz'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produtos | Fruit Bubbles</title>

    <link rel="stylesheet" href="produto.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <?php include_once "_cabecalho.php"; ?>  

    <main>
 
        <!-- Banner da coleção de produtos -->
        <section class="colecao-banner">

            <div class="colecao-conteudo">

                <div class="colecao-texto">
                    <h1>
                        Nossa coleção <span>frutada</span>
                    </h1>

                    <p>
                        Descubra sabonetes artesanais feitos com ingredientes naturais
                        e fragrâncias frutadas para transformar seu banho em um momento especial.
                    </p> 
                </div>

                <div 
                    class="colecao-imagem" 
                    role="img" 
                    aria-label="Coleção de sabonetes artesanais Fruit Bubbles">
                </div>

            </div>

        </section>

        <!-- Seção de produtos -->
        <section class="produtos" id="produtos">

            <div class="titulo-secao-produtos">

                <h2>
                    Nossos produtos
                </h2>

                <p>
                    Sabonetes artesanais para todos os momentos.
                </p>

            </div>
            
            <!-- Lista de produtos -->
            <div class="grid-produtos">

                <?php foreach ($produtosBanco as $p): ?>

                    <?php
                        $id = $p['id_produto'];
                        $imagem = !empty($p['imagem']) ? $p['imagem'] : ($imagensPorId[$id] ?? "img/produto-padrao.jpg");
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
 
    <!-- Toast de confirmação de adição ao carrinho -->
    <div id="toast" class="toast">

        <span id="toast-message">
            Produto adicionado ao carrinho!
        </span>

    </div>

    <?php include_once "_footer.php"; ?>
 
    <script src="script.js" defer></script>  

</body>
</html>