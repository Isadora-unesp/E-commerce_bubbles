<?php

$produtos = [
    [
        "nome" => "Frutas Vermelhas", 
        "peso" => "90 g",
        "preco" => 12.50,
        "imagem" => "img/morango.jpg"
    ],
    [
        "nome" => "Maracujá", 
        "peso" => "90 g",
        "preco" => 11.90,
        "imagem" => "img/maracuja.jpg"
    ],
    [
        "nome" => "Mirtilo", 
        "peso" => "90 g",
        "preco" => 13.20,
        "imagem" => "img/mirtilo.jpg"
    ],
    [
        "nome" => "Coco", 
        "peso" => "120 g",
        "preco" => 10.50,
        "imagem" => "img/coco.jpg"
    ],
    [
        "nome" => "Cítrico", 
        "peso" => "90 g",
        "preco" => 10.80,
        "imagem" => "img/citrico.jpg"
    ]
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

<header class="header">

    <button
        type="button"
        class="menu-mobile"
        id="botaoMenuMobile"
        aria-label="Abrir menu"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

    <a href="index.php" class="logo">
        <img src="img/logo2.png" alt="Fruit Bubbles">
    </a>

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

            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
            </svg>

        </a>

        <button
            type="button"
            class="carrinho"
            id="botaoCarrinho"
            aria-label="Carrinho"
        >

            <svg viewBox="0 0 24 24">
                <path d="M3 4h2l2.5 11h10L20 7H6"></path>
                <circle cx="9" cy="19" r="1.5"></circle>
                <circle cx="17" cy="19" r="1.5"></circle>
            </svg>

            <span id="contadorCarrinho">0</span>

        </button>

    </div>

</header>


<div class="fundo-menu-mobile" id="fundoMenuMobile"></div>

<aside class="menu-lateral-mobile" id="menuLateralMobile">

    <div class="menu-mobile-cabecalho">

        <h2>Menu</h2>

        <button
            type="button"
            id="fecharMenuMobile"
            aria-label="Fechar menu"
        >
            ×
        </button>

    </div>

    <nav class="menu-mobile-itens">

        <a href="index.php" class="menu-mobile-item">
            Início
        </a>

        <div class="menu-mobile-produtos">

            <button
                type="button"
                id="botaoProdutosMobile"
                class="menu-mobile-item"
            >
                <span>Produtos</span>
                <span class="seta">⌄</span>
            </button>

            <div
                class="submenu-mobile"
                id="submenuProdutosMobile"
            >

                <a href="produtos.php">
                    Todos os produtos
                </a>

                <a href="produtos.php?categoria=massageador">
                    Sabonete massageador
                </a>

                <a href="produtos.php?categoria=barra">
                    Sabonete em barra
                </a>

            </div>

        </div>

        <a href="ingredientes.php" class="menu-mobile-item">
            Ingredientes
        </a>

        <a href="sobre.php" class="menu-mobile-item">
            Sobre nós
        </a>

    </nav>

</aside>


<main>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-texto">

            <span class="subtitulo">
                FEITO COM FRUTAS. FEITO COM AMOR.
            </span>

            <h1>
                Seu momento de
                <em>autocuidado</em>
                começa aqui
            </h1>

            <p>
                Sabonetes artesanais com frutas, aromas incríveis
                e todo o cuidado que sua pele merece.
            </p>

            <a href="#produtos" class="botao">
                Conheça nossos produtos
                <span>→</span>
            </a>

        </div>

        <div class="hero-imagem">
            <img
                src="img/banner.png"
                alt="Sabonetes artesanais Fruit Bubbles"
            >
        </div>

        <div class="hero-controles">
            <button>‹</button>

            <div class="hero-pontos">
                <span class="ativo"></span>
                <span></span>
                <span></span>
            </div>

            <button>›</button>
        </div>

    </section>


    <!-- PRODUTOS -->

    <section class="produtos" id="produtos">

        <div class="titulo-secao">

            <div class="titulo-decoracao"></div>

            <h2>
                Encontre seu sabonete
                <em>favorito</em>
            </h2>

            <div class="titulo-decoracao"></div>

        </div>

        <a href="produtos.php" class="ver-todos">
            Ver todos →
        </a>

        <div class="produtos-scroll">

            <?php foreach ($produtos as $produto): ?>

                <article
                    class="produto"
                    data-nome="<?= strtolower($produto['nome']) ?>"
                    data-preco="<?= $produto['preco'] ?>"
                >

                    <div class="produto-imagem">

                        <img
                            src="<?= $produto['imagem'] ?>"
                            alt="Sabonete <?= $produto['nome'] ?>"
                        >

                    </div>

                    <div class="produto-info">

                        <h3>
                            <?= $produto['nome'] ?>
                        </h3>

                        <span class="produto-peso">
                            <?= $produto['peso'] ?>
                        </span>

                        <strong class="produto-preco">
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
                            data-produto="<?= htmlspecialchars($produto['nome']) ?>"
                            onclick="adicionarCarrinho('<?= htmlspecialchars($produto['nome'], ENT_QUOTES) ?>', this)"
                        >
                            Adicionar ao carrinho
                        </button>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>


    <!-- CATEGORIAS -->

    <section class="categorias">

        <a
            href="produtos.php?categoria=barra"
            class="categoria categoria-barra"
        >

            <div class="categoria-icone">
                ●
            </div>

            <div class="categoria-texto">

                <h3>
                    Sabonetes em barra
                </h3>

                <p>
                    Limpeza e suavidade para o seu dia a dia
                </p>

            </div>

            <span class="categoria-seta">
                ›
            </span>

        </a>


        <a
            href="produtos.php?categoria=massageador"
            class="categoria categoria-massageador"
        >

            <div class="categoria-icone">
                ●
            </div>

            <div class="categoria-texto">

                <h3>
                    Sabonetes massageadores
                </h3>

                <p>
                    Relaxamento e bem-estar em cada banho
                </p>

            </div>

            <span class="categoria-seta">
                ›
            </span>

        </a>

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

            <span class="subtitulo">
                INGREDIENTES NATURAIS
            </span>

            <h2>
                Ingredientes que
                fazem a <em>diferença</em>
            </h2>

            <p>
                Selecionamos cuidadosamente ingredientes
                naturais e nutritivos para criar sabonetes
                que respeitam sua pele e o meio ambiente.
            </p>

            <a href="ingredientes.php" class="botao verde">
                Conheça os ingredientes
                <span>→</span>
            </a>

        </div>

    </section>


    <!-- POR QUE ESCOLHER -->

    <section class="diferenciais">

        <div class="titulo-secao">

            <div class="titulo-decoracao"></div>

            <h2>
                Por que escolher a
                <em>Fruit Bubbles?</em>
            </h2>

            <div class="titulo-decoracao"></div>

        </div>


        <div class="diferenciais-lista">

            <div class="diferencial">

                

                <div>
                    <h3>Artesanal</h3>

                    <p>
                        Feito à mão, com muito cuidado e carinho.
                    </p>
                </div>

            </div>


            <div class="diferencial">

                <div class="diferencial-icone">
                    🍊
                </div>

                <div>
                    <h3>Fragrâncias agradáveis</h3>

                    <p>
                        Aromas que transformam o seu banho em um momento especial.
                    </p>
                </div>

            </div>


            <div class="diferencial">

                <div class="diferencial-icone">
                    🥥
                </div>

                <div>
                    <h3>Autocuidado</h3>

                    <p>
                        Mais bem-estar, frescor e cuidado para a pele.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- SOBRE -->
    <section class="sobre-resumo">

        <div class="sobre-resumo-texto">

            <span class="subtitulo">SOBRE A FRUIT BUBBLES</span>

            <h2>
                Feito por nós,<br>
                pensado para você.
            </h2>

            <p>
                Somos a Fruit Bubbles, uma empresa criada a partir de um
                projeto de e-commerce escolar. Desenvolvemos sabonetes
                artesanais inspirados em frutas, unindo cuidado, criatividade
                e carinho em cada produto.
            </p>

            <p>
                Nosso site foi desenvolvido como parte da nossa experiência
                de aprendizagem, colocando em prática conhecimentos de
                tecnologia, empreendedorismo e desenvolvimento web.
            </p>

            <br></br>
            <a href="sobrenos.php" class="botao verde">
                Conheça nossa história
                <span>→</span>
            </a>

        </div>

        <div class="sobre-resumo-destaque">
            <img src="img/logo.png" alt="Logo Fruit Bubbles">
        </div>

    </section>

</main>


<!-- FOOTER -->

<footer id="contato">

    <div class="footer-logo">

        <div class="logo">

            <img
                src="img/logo2.png"
                alt="Fruit Bubbles"
            >

        </div>

        <p>
            Sabonetes artesanais feitos com ingredientes
            naturais e muito amor para cuidar de você.
        </p>

        <div class="redes">

            <a href="#">Instagram</a>
            <a href="#">TikTok</a>
            <a href="#">YouTube</a>

        </div>

    </div>


    <div class="footer-coluna">

        <h3>Navegação</h3>

        <a href="index.php">Início</a>
        <a href="produtos.php">Produtos</a>
        <a href="ingredientes.php">Ingredientes</a>
        <a href="sobre.php">Sobre nós</a>

    </div>


    <div class="footer-coluna">

        <h3>Ajuda</h3>

        <a href="#">Formas de pagamento</a>
        <a href="#">Entrega</a>
        <a href="#">Trocas e devoluções</a>
        <a href="#">Dúvidas frequentes</a>

    </div>

    <div class="copyright">
        2026 Fruit Bubbles: E-commerce.
    </div>

</footer>


<script src="script.js" defer></script>


<!-- CARRINHO -->

<div class="fundo-carrinho" id="fundoCarrinho"></div>

<aside class="carrinho-lateral" id="carrinhoLateral">

    <div class="carrinho-cabecalho">

        <h2>Seu carrinho</h2>

        <button
            type="button"
            class="fechar-carrinho"
            id="fecharCarrinho"
        >
            ×
        </button>

    </div>


    <div
        class="carrinho-produtos"
        id="carrinhoProdutos"
    >
    </div>


    <div class="carrinho-rodape">

        <div class="carrinho-total">

            <span>Total:</span>

            <strong id="totalCarrinho">
                R$ 0,00
            </strong>

        </div>


        <button
            type="button"
            class="continuar-comprando"
            id="continuarComprando"
        >
            Continuar comprando
        </button>


        <button
            type="button"
            class="finalizar-compra"
            onclick="window.location.href='carrinho.php'"
        >
            Finalizar compra
        </button>

    </div>

</aside>

</body>
</html>