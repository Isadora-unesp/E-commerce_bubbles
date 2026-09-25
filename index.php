<?php

session_start();

$produtos = [
    [
        "nome" => "Frutas Vermelhas",
        "peso" => "90 g",
        "preco" => 12.50,
        "imagem" => "img/morango.jpg",
        "pagina" => "produtosIndividuais/sab1.php"
    ],
    [
        "nome" => "Maracujá",
        "peso" => "150 g",
        "preco" => 11.90,
        "imagem" => "img/maracuja.jpg",
        "pagina" => "produtosIndividuais/sab2.php"
    ], 
    [
        "nome" => "Coco",
        "peso" => "150 g",
        "preco" => 10.50,
        "imagem" => "img/coco.jpg",
        "pagina" => "produtosIndividuais/sab4.php"
    ],
    [
        "nome" => "Cítrico",
        "peso" => "90 g",
        "preco" => 10.80,
        "imagem" => "img/citrico.jpg",
        "pagina" => "produtosIndividuais/sab5.php"
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

    <?php include '_cabecalho.php'; ?>

    <div class="fundo-pesquisa" id="fundoPesquisa"></div>

    <section class="painel-pesquisa" id="painelPesquisa">

        <div class="pesquisa-topo">
            <div class="pesquisa-campo">
                <input
                    type="text"
                    id="campoPesquisa"
                    placeholder="O que você está buscando?"
                    autocomplete="off"
                >
                <button type="button" id="botaoPesquisar" aria-label="Pesquisar">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                    </svg>
                </button>
            </div>

            <button
                type="button"
                class="fechar-pesquisa"
                id="fecharPesquisa"
                aria-label="Fechar pesquisa"
            >
                ×
            </button>
        </div>

        <div class="pesquisa-conteudo">

            <p class="pesquisa-instrucao" id="pesquisaInstrucao">
                Digite o nome de um sabonete para pesquisar.
            </p>

            <h2 class="pesquisa-titulo" id="tituloResultado"></h2>

            <div class="resultados-pesquisa" id="resultadosPesquisa">

                <?php foreach ($produtos as $produto): ?>
                    <div
                        class="produto-pesquisa"
                        data-nome="<?= htmlspecialchars(strtolower($produto['nome'])) ?>"
                    >

                        <div class="produto-pesquisa-imagem">

                            <img
                                src="<?= htmlspecialchars($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                            >

                        </div>

                        <div class="produto-pesquisa-info">

                            <span class="produto-pesquisa-tipo">
                                Fruit Bubbles
                            </span>

                            <h3>
                                <?= htmlspecialchars($produto['nome']) ?>
                            </h3>

                            <span class="produto-pesquisa-peso">
                                <?= htmlspecialchars($produto['peso']) ?>
                            </span>

                            <strong>
                                R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                            </strong>

                            <button
                                type="button"
                                class="produto-pesquisa-comprar"
                                onclick="adicionarCarrinho(
                                    '<?= addslashes($produto['nome']) ?>',
                                    this
                                )"
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <p class="nenhum-resultado" id="nenhumResultado">
                Nenhum produto encontrado.
            </p>
        </div>
    </section>

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

            <a href="sobrenos.php" class="menu-mobile-item">
                Sobre nós
            </a>

            <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) { ?>
                <a href="perfilUsuario.php" class="menu-mobile-item">
                    👤 Perfil
                </a>
            <?php } else { ?>
                <a href="login.php" class="menu-mobile-item">
                    👤 Perfil
                </a>
            <?php } ?>

        </nav>

    </aside>


    <main>

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

                <a href="produtos.php" class="botao">
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
                
                <br></br>
                <br></br>

                <div class="titulo-decoracao"></div>

            </div> 

            <div class="produtos-scroll">

                <?php foreach ($produtos as $indice => $produto): ?>

                    <article
                        class="produto"
                        data-nome="<?= strtolower($produto['nome']) ?>"
                        data-preco="<?= $produto['preco'] ?>"
                        onclick="window.location.href='<?= $produto['pagina'] ?>'"
                        style="cursor: pointer;"
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
                                onclick="event.stopPropagation(); adicionarCarrinho('<?= htmlspecialchars($produto['nome'], ENT_QUOTES) ?>', this)"
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </section> 
 
        <!-- ingredientes -->
        <section class="ingredientes">

            <div class="ingredientes-texto">

                <span class="subtitulo">
                    INGREDIENTES NATURAIS
                </span>

                <h2>
                    Ingredientes<br>
                    que fazem a <em>diferença</em>
                </h2>

                <p>
                    Selecionamos cuidadosamente ingredientes naturais e nutritivos
                    para criar sabonetes que respeitam sua pele e o meio ambiente.
                </p>

                <a href="ingredientes.php" class="botao">
                    Conheça os ingredientes
                    <span>→</span>
                </a>

            </div>

            <div class="ingredientes-imagem">
                <img
                    src="img/ingrediente.png"
                    alt="Ingredientes naturais utilizados nos sabonetes"
                >
            </div>

        </section>


        <!-- diferenciais -->
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
                    <div class="diferencial-icone diferencial-morango">
                        <svg viewBox="0 0 64 64" aria-hidden="true"> 
                            <path
                                d="M32 17
                                C26 12 21 12 18 14
                                C22 16 24 19 25 22
                                C28 20 30 19 32 19
                                C34 19 37 20 39 22
                                C40 18 43 16 47 14
                                C42 12 37 13 32 17Z"
                                fill="#66825a"
                            /> 
                            <path
                                d="M18 24
                                C18 18 24 16 32 16
                                C40 16 46 18 46 24
                                C46 34 39 46 32 52
                                C25 46 18 34 18 24Z"
                                fill="#f86464"
                            /> 
                            <ellipse cx="25" cy="27" rx="1.4" ry="2" fill="#fff2e8"/>
                            <ellipse cx="32" cy="25" rx="1.4" ry="2" fill="#fff2e8"/>
                            <ellipse cx="39" cy="28" rx="1.4" ry="2" fill="#fff2e8"/>
                            <ellipse cx="28" cy="35" rx="1.4" ry="2" fill="#fff2e8"/>
                            <ellipse cx="36" cy="35" rx="1.4" ry="2" fill="#fff2e8"/>
                            <ellipse cx="32" cy="43" rx="1.4" ry="2" fill="#fff2e8"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Artesanal</h3> 
                        <p>
                            Feito à mão, com muito cuidado e carinho.
                        </p>
                    </div> 
                </div>
 
                <div class="diferencial">
                    <div class="diferencial-icone diferencial-laranja">
                        <svg viewBox="0 0 64 64" aria-hidden="true"> 
                            <path
                                d="M31 18
                                C34 10 43 8 49 12
                                C45 18 39 21 32 20Z"
                                fill="#66825a"
                            /> 
                            <path
                                d="M32 21 C32 17 31 14 29 11"
                                fill="none"
                                stroke="#56744d"
                                stroke-width="3"
                                stroke-linecap="round"
                            /> 
                            <circle
                                cx="32"
                                cy="35"
                                r="17"
                                fill="#f4a63a"
                            /> 
                            <circle
                                cx="27"
                                cy="29"
                                r="6"
                                fill="#ffc866"
                                opacity="0.55"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3>Fragrâncias agradáveis</h3> 
                        <p>
                            Aromas que transformam o seu banho em um momento especial.
                        </p>
                    </div> 
                </div>
 
                <div class="diferencial">
                    <div class="diferencial-icone diferencial-coco">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
                            <circle
                                cx="32"
                                cy="32"
                                r="20"
                                fill="#9a6549"
                            />
                            <circle
                                cx="32"
                                cy="32"
                                r="15"
                                fill="#fff8eb"
                            />
                            <circle
                                cx="32"
                                cy="32"
                                r="11"
                                fill="#f3ead6"
                            />
                            <path
                                d="M18 22 C14 29 14 36 18 43"
                                fill="none"
                                stroke="#784a37"
                                stroke-width="2"
                                stroke-linecap="round"
                            />
                            <path
                                d="M46 21 C51 29 51 36 46 44"
                                fill="none"
                                stroke="#784a37"
                                stroke-width="2"
                                stroke-linecap="round"
                            />
                        </svg>
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


        <!-- sobre -->
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

    <?php include '_footer.php'; ?>

    <script src="script.js" defer></script>


    <!-- carrinho -->
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