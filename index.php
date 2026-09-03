<?php

$produtos = [
    [
        "nome" => "Sabonete Frutas Vermelhas",
        "descricao" => "Fragrância doce e frutada, com uma combinação delicada de morango e frutas vermelhas. 90g",
        "preco" => 15.00,
        "imagem" => "img/morango.jpg"
    ],
    [
        "nome" => "Sabonete Maracujá",
        "descricao" => "Fragrância refrescante de maracujá, ideal para deixar a pele perfumada. 90g",
        "preco" => 9.00,
        "imagem" => "img/maracuja.jpg"
    ],
    [
        "nome" => "Sabonete Mirtilo",
        "descricao" => "Fragrância suave e marcante de mirtilo, trazendo um toque frutado para o seu momento de cuidado. 90g",
        "preco" => 10.00,
        "imagem" => "img/mirtilo.jpg"
    ],
    [
        "nome" => "Sabonete Coco",
        "descricao" => "Fragrância suave de coco que proporciona uma sensação de frescor e cuidado durante o banho. 90g",
        "preco" => 12.00,
        "imagem" => "img/coco.jpg"
    ],
    [
        "nome" => "Sabonete Cítrico",
        "descricao" => "Fragrância refrescante com notas cítricas, perfeita para trazer uma sensação de energia e frescor. 90g",
        "preco" => 9.00,
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
            <a href="index.php">Início</a>
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

                <svg viewBox="0 0 24 24" aria-hidden="true">
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

        <br></br>
 
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
                        <span>→</span>
                    </a>
                </div> 
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
                        <span>→</span>
                    </a>
                </div> 
            </div> 
        </section>
  
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
                        data-preco="<?= $produto['preco'] ?>"
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

                            <p class="produto-descricao">
                                <?= $produto['descricao'] ?>
                            </p>

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
                                    data-produto="<?= htmlspecialchars($produto['nome']) ?>"
                                    onclick="adicionarCarrinho('<?= htmlspecialchars($produto['nome'], ENT_QUOTES) ?>', this)"
                                >
                                    Adicionar ao carrinho
                                </button>
                            </div>
                        </div>
                    </article>

                <?php endforeach; ?>

            </div>

        </section>

    </main>

    <!-- SOBRE NÓS -->
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
            <a href="sobre.php" class="botao verde">
                Conheça nossa história
                <span>→</span>
            </a>

        </div>

        <div class="sobre-resumo-destaque">
            <img src="img/logo.png" alt="Logo Fruit Bubbles">
        </div>

    </section>
 
    <footer id="contato">

        <div class="footer-logo">
            <div class="logo">
                <img src="img/logo2.png" alt="Fruit Bubbles - Sabonetes Artesanais">
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
            E-commerce 2026 Fruit Bubbles. 
        </div>

    </footer>

    
    <script src="script.js" defer></script>

    <!-- CARRINHO LATERAL -->

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


        <div class="carrinho-produtos" id="carrinhoProdutos">
            <!-- Produtos adicionados aparecem aqui -->
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