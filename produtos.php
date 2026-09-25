<?php
session_start();
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

    <!-- MENU MOBILE -->
    <div class="fundo-menu-mobile" id="fundoMenuMobile"></div>

    <aside class="menu-lateral-mobile" id="menuLateralMobile">

        <div class="menu-mobile-cabecalho">

            <h2>Menu</h2>

            <button type="button" id="fecharMenuMobile" aria-label="Fechar menu">
                ×
            </button>

        </div>

        <nav class="menu-mobile-itens">

            <!-- Como este arquivo está em /produtosIndividuais, os links precisam de ../ -->
            <a href="../index.php" class="menu-mobile-item">
                Início
            </a>

            <div class="menu-mobile-produtos">

                <button type="button" id="botaoProdutosMobile" class="menu-mobile-item">
                    <span>Produtos</span>
                    <span class="seta">⌄</span>
                </button>

                <div class="submenu-mobile" id="submenuProdutosMobile">

                    <a href="../produtos.php">
                        Todos os produtos
                    </a>

                    <a href="../produtos.php?categoria=massageador">
                        Sabonete massageador
                    </a>

                    <a href="../produtos.php?categoria=barra">
                        Sabonete em barra
                    </a>

                </div>

            </div>

            <a href="../ingredientes.php" class="menu-mobile-item">
                Ingredientes
            </a>

            <a href="../sobrenos.php" class="menu-mobile-item">
                Sobre nós
            </a>

            <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) { ?>
                <a href="../perfilUsuario.php" class="menu-mobile-item">
                    👤 Perfil
                </a>
            <?php } else { ?>
                <a href="../login.php" class="menu-mobile-item">
                    👤 Perfil
                </a>
            <?php } ?>

        </nav>

    </aside>

    <main>


        <!-- =================================================
             HERO
        ================================================== -->

        <section class="hero-produtos">

            <div class="hero-produtos-texto">

                <span class="subtitulo">
                    FEITO COM FRUTAS. FEITO COM AMOR.
                </span>

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

                <span class="subtitulo">
                    ESCOLHA O SEU FAVORITO
                </span>

                <h2>
                    Nossos produtos
                </h2>

                <p>
                    Sabonetes artesanais para todos os momentos.
                </p>

            </div>


            <!-- MENSAGEM CASO NÃO ENCONTRE PRODUTO -->

            <div id="no_results">
                Nenhum produto encontrado. 🍃
            </div> 

            <!-- CARDS -->
 
            <div class="grid-produtos"> 

                <!-- MARACUJÁ -->

                <article class="produto" data-nome="passion">

                    <a href="produtosIndividuais/sab2.php" class="link-produto">
                        <div class="produto-imagem">
                            <img
                                src="img/maracuja.jpg"
                                alt="Sabonete Passion de Maracujá"
                            >
                        </div>

                        <div class="produto-info">
                            <h3>Maracujá</h3>

                            <p class="descricao">
                                Calmante e esfoliante suave com sementes
                                naturais de maracujá.
                            </p>
                        </div>
                    </a>

                    <div class="produto-final">

                        <strong>R$ 11,90</strong>

                        <button
                            type="button"
                            class="adicionar"
                            onclick="adicionarCarrinho('Maracujá', this)"
                        >
                            Adicionar ao carrinho
                        </button>

                    </div>

                </article>


                <!-- COCO -->

                <article class="produto" data-nome="coconut">

                    <a href="produtosIndividuais/sab4.php" class="link-produto">
                        <div class="produto-imagem">
                            <img
                                src="img/coco.jpg"
                                alt="Sabonete Coconut de Coco"
                            >
                        </div>

                        <div class="produto-info">
                            <h3>Coco</h3>

                            <p class="descricao">
                                Sabonete artesanal de coco com fragrância
                                suave e agradável para o cuidado da pele.
                            </p>
                        </div>
                    </a>

                    <div class="produto-final">

                        <strong>R$ 10,50</strong>

                        <button
                            type="button"
                            class="adicionar"
                            onclick="adicionarCarrinho('Coco', this)"
                        >
                            Adicionar ao carrinho
                        </button>

                    </div>

                </article>


                <!-- FRUTAS VERMELHAS -->

                <article class="produto" data-nome="fraguna">

                    <a href="produtosIndividuais/sab1.php" class="link-produto">
                        <div class="produto-imagem">
                            <img
                                src="img/morango.jpg"
                                alt="Sabonete Fraguna de Frutas Vermelhas"
                            >
                        </div>

                        <div class="produto-info">
                            <h3>Frutas Vermelhas</h3>

                            <p class="descricao">
                                Fragrância doce e frutada, com uma combinação
                                delicada de morango e frutas vermelhas.
                            </p>
                        </div>
                    </a>

                    <div class="produto-final">

                        <strong>R$ 12,50</strong>

                        <button
                            type="button"
                            class="adicionar"
                            onclick="adicionarCarrinho('Frutas Vermelhas', this)"
                        >
                            Adicionar ao carrinho
                        </button>

                    </div>

                </article>


                <!-- CÍTRICO -->

                <article class="produto" data-nome="citrico">

                    <a href="produtosIndividuais/sab5.php" class="link-produto">
                        <div class="produto-imagem">
                            <img
                                src="img/citrico.jpg"
                                alt="Sabonete Cítrico"
                            >
                        </div>

                        <div class="produto-info">
                            <h3>Cítrico</h3>

                            <p class="descricao">
                                Fragrância cítrica refrescante para deixar
                                o banho mais leve e revigorante.
                            </p>
                        </div>
                    </a>

                    <div class="produto-final">

                        <strong>R$ 10,80</strong>

                        <button
                            type="button"
                            class="adicionar"
                            onclick="adicionarCarrinho('Cítrico', this)"
                        >
                            Adicionar ao carrinho
                        </button>

                    </div>

                </article>

            </div>

        </section>


        <!-- =================================================
             MENSAGEM FINAL
        ================================================== -->

        <section class="mensagem-final">

            <h2>
                Um sabonete para cada momento
            </h2>

            <p>
                Escolha sua fragrância favorita e transforme
                seu banho em uma experiência especial.
            </p>

        </section>

    </main>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div id="toast" class="toast">

        <span id="toast-message">
            Produto adicionado ao carrinho!
        </span>

    </div>

    <?php include_once "_footer.php"; ?>
 
    <script src="script.js" defer></script> 

    <!-- CARRINHO LATERAL -->
    <div class="fundo-carrinho" id="fundoCarrinho"></div>

    <aside class="carrinho-lateral" id="carrinhoLateral">

        <div class="carrinho-cabecalho">

            <h2>Seu carrinho</h2>

            <button type="button" class="fechar-carrinho" id="fecharCarrinho">×</button>

        </div>


        <div class="carrinho-produtos" id="carrinhoProdutos"></div>


        <div class="carrinho-rodape">

            <div class="carrinho-total">

                <span>Total:</span>

                <strong id="totalCarrinho">R$ 0,00</strong>

            </div>


            <button type="button" class="continuar-comprando" id="continuarComprando">
                Continuar comprando
            </button>


            <button
                type="button"
                class="finalizar-compra"
                onclick="window.location.href='../carrinho.php'">

                Finalizar compra

            </button>

        </div>

    </aside>


</body>
</html>