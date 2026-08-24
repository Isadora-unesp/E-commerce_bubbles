<?php

$produtos = [
    [
        "nome" => "Sabonete Frutas Vermelhas",
        "preco" => 00.00,
        "imagem" => "img/morango.jpg"
    ],
    [
        "nome" => "Sabonete Maracujá",
        "preco" => 00.00,
        "imagem" => "img/maracuja.jpg"
    ],
    [
        "nome" => "Sabonete Mirtilo",
        "preco" => 00.00,
        "imagem" => "img/mirtilo.jpg"
    ],
    [
        "nome" => "Sabonete Coco",
        "preco" => 00.00,
        "imagem" => "img/coco.jpg"
    ],
    [
        "nome" => "Sabonete Citríco",
        "preco" => 00.00,
        "imagem" => "img/citrico.jpg"
    ],
];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fruit Bubbles | Sabonetes Artesanais</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- CABEÇALHO -->
    <header class="header">

        <div class="logo">
            <span>fruit</span>
            <span>bubbles</span>
            <small>SABONETES ARTESANAIS</small>
        </div>

        <nav class="menu">
            <a href="index.php" class="ativo">Início</a>
            <a href="produtos.php">Produtos</a>
            <a href="ingredientes.php">Ingredientes</a>
            <a href="sobre.php">Sobre nós</a>
        </nav>

        <div class="acoes">

            <div class="pesquisa">
                <input
                    type="text"
                    id="campoPesquisa"
                    placeholder="Buscar produtos..."
                    autocomplete="off"
                >

                <button
                    type="button"
                    id="botaoBusca"
                    aria-label="Pesquisar"
                >
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                    </svg>
                </button>
            </div>

            <a href="login.php" class="icone" aria-label="Minha conta">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                </svg>
            </a>

            <a href="carrinho.php" class="carrinho" aria-label="Carrinho">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 4h2l2.5 11h10L20 7H6"></path>
                    <circle cx="9" cy="19" r="1.5"></circle>
                    <circle cx="17" cy="19" r="1.5"></circle>
                </svg>
            </a>

        </div>

    </header>


    <!-- BANNER PRINCIPAL -->
    <main>

        <section class="hero">

            <div class="hero-texto">

                <span class="subtitulo">
                    FEITO COM FRUTAS. FEITO COM AMOR.
                </span>

                <h1>
                    Sabonetes artesanais
                    que cuidam de <strong>você</strong>
                    e da <strong>natureza.</strong>
                </h1>

                <p>
                    Nossos sabonetes são feitos com ingredientes
                    naturais e fragrâncias frutadas que transformam
                    seu banho em um momento único.
                </p>

                <a href="#produtos" class="botao">
                    Conheça nossos produtos
                    <span>→</span>
                </a>

            </div>

            <div class="hero-imagem">
                <img src="img/banner.png" alt="Sabonetes artesanais Fruit Bubbles">
            </div>

        </section>


        <!-- BENEFÍCIOS -->
        <section class="beneficios">

            <div class="beneficio">
                <span class="beneficio-icone">🌿</span>

                <div>
                    <strong>Ingredientes naturais</strong>
                    <p>Fórmulas suaves e seguras para sua pele</p>
                </div>
            </div>


            <div class="beneficio">
                <span class="beneficio-icone">♡</span>

                <div>
                    <strong>Feito com carinho</strong>
                    <p>Produção artesanal em pequenos lotes</p>
                </div>
            </div>

            <div class="beneficio">
                <span class="beneficio-icone">🍃</span>

                <div>
                    <strong>Sem parabenos</strong>
                    <p>Mais cuidado para você</p>
                </div>
            </div>


            <div class="beneficio">
                <span class="beneficio-icone">♻</span>

                <div>
                    <strong>Embalagens sustentáveis</strong>
                    <p>Cuidado com você e o planeta</p>
                </div>
            </div>

        </section>


        <!-- TIPOS DE SABONETE -->
        <section class="categorias">

            <div class="categoria categoria-massageador">

                <div class="categoria-texto">
                    <h2>
                        Sabonete<br>
                        massageador
                    </h2>
                    <p>
                        Com texturas que massageiam e esfoliam
                        suavemente, promovendo relaxamento
                        e renovação da pele.
                    </p>
                    <a href="#produtos" class="botao pequeno">
                        Ver produtos
                    </a>
                </div>

                <img
                    src="img/massageador.jpg"
                    alt="Sabonete massageador"
                >

            </div>


            <div class="categoria categoria-barra">
                <div class="categoria-texto">
                    <h2>
                        Sabonete<br>
                        em barra
                    </h2>
                    <p>
                        Fórmulas suaves e fragrâncias irresistíveis
                        para uma limpeza delicada e perfumada.
                    </p>
                    <a href="#produtos" class="botao verde pequeno">
                        Ver produtos
                    </a>
                </div>

                <img
                    src="img/barra.jpg"
                    alt="Sabonetes em barra"
                >
            </div>

        </section>

        <!-- INGREDIENTES -->
        <section class="ingredientes" id="ingredientes">
            <div class="ingredientes-imagem">
                <img
                    src="img/ingrediente.png"
                    alt="Ingredientes naturais utilizados nos sabonetes"
                >
            </div>

            <div class="ingredientes-texto">
                <h2>
                    Ingredientes<br>
                    que fazem a diferença
                </h2>
                <p>
                    Selecionamos cuidadosamente ingredientes
                    naturais e nutritivos para criar sabonetes
                    que respeitam sua pele e o meio ambiente.
                </p>
                <a href="ingredientes.php" class="botao verde">
                    Ir para ingredientes
                    <span>→</span>
                </a>
            </div>
        </section>

        <!-- PRODUTOS -->
        <section class="produtos" id="produtos">

            <div class="titulo-secao">
                <h2>Nossos produtos</h2>
                <a href="produtos.php" class="ver-todos">
                    Ver todos →
                </a>
            </div>

            <div class="produtos-scroll">

                <?php foreach ($produtos as $produto): ?>

                    <article
                        class="produto"
                        data-nome="<?= strtolower($produto['nome']) ?>"
                    >

                        <div class="produto-imagem">
                            <img
                                src="<?= $produto['imagem'] ?>"
                                alt="<?= $produto['nome'] ?>"
                            >
                        </div>

                        <div class="produto-info">
                            <h3>
                                <?= $produto['nome'] ?>
                            </h3>

                            <div class="produto-final">

                                <strong>
                                    R$
                                    <?= number_format(
                                        $produto['preco'],
                                        2,
                                        ',',
                                        '.'
                                    ) ?>
                                </strong>

                                <button
                                    class="adicionar"
                                    onclick="adicionarCarrinho('<?= $produto['nome'] ?>')"
                                >
                                    🛒
                                </button>
                            </div>
                        </div>
                    </article>

                <?php endforeach; ?>

            </div>

        </section>

    </main>

    <!-- RODAPÉ -->
    <footer id="contato">

        <div class="footer-logo">
            <div class="logo">
                <span>fruit</span>
                <span>bubbles</span>
                <small>SABONETES ARTESANAIS</small>
            </div>
            <p>
                Sabonetes artesanais feitos com ingredientes
                naturais e muito amor para cuidar de você.
            </p>
            <div class="redes">
                <a href="#">Instagram</a>
                <a href="#">TikTok</a>
            </div>
        </div>


        <div class="footer-coluna">
            <h3>Institucional</h3>
            <a href="#">Sobre nós</a>
            <a href="ingredientes.php">Nossos ingredientes</a>
            <a href="#">Sustentabilidade</a>
            <a href="#">Contato</a>
        </div>

        <div class="footer-coluna">
            <h3>Formas de pagamento</h3>
            <div class="pagamentos">
                <span>Dinheiro</span>
                <span>PIX</span>
            </div>
        </div>

        <div class="copyright">
            © 2026 Fruit Bubbles.
            Todos os direitos reservados.
        </div>

    </footer>

    <script src="script.js"></script>

</body>
</html>