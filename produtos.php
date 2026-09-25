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
</head>

<body>

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <header class="header">

        <a href="index.php" class="logo">
            <img src="img/logo.png" alt="Fruit Bubbles">
        </a>

        <nav class="menu">
            <a href="index.php">Início</a>
            <a href="produtos.php" class="ativo">Produtos</a>
            <a href="ingredientes.php">Ingredientes</a>
            <a href="sobre.php">Sobre nós</a>
        </nav>

        <div class="acoes">

            <!-- BUSCA -->
            <div class="pesquisa">

                <input
                    type="text"
                    id="campoPesquisa"
                    placeholder="Buscar sabonete..."
                    autocomplete="off"
                >

                <button
                    type="button"
                    id="botaoBusca"
                    aria-label="Pesquisar"
                >
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line
                            x1="16.5"
                            y1="16.5"
                            x2="21"
                            y2="21"
                        ></line>
                    </svg>
                </button>

                <div
                    id="suggestions-dropdown"
                    class="suggestions-dropdown"
                ></div>

            </div>


            <!-- CONTA -->
            <a
                href="login.php"
                class="icone"
                aria-label="Minha conta"
            >
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                </svg>
            </a>


            <!-- CARRINHO -->
            <a
                href="carrinho.php"
                class="carrinho"
                aria-label="Carrinho"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M3 4h2l2.5 11h10L20 7H6"></path>
                    <circle cx="9" cy="19" r="1.5"></circle>
                    <circle cx="17" cy="19" r="1.5"></circle>
                </svg>

                <span id="cart-count">0</span>
            </a>

        </div>

    </header>


    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

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

                <article
                    class="produto"
                    data-nome="passion"
                    data-pagina="../produtosIndividuais/sab2.php"
                >

                    <div class="produto-imagem imagem-maracuja">
                        <span>💛</span>
                    </div>

                    <div class="produto-info">

                        <h3>
                            Passion
                        </h3>

                        <p class="descricao">
                            Calmante e esfoliante suave com sementes
                            naturais de maracujá.
                        </p>

                        <div class="produto-final">

                            <strong>
                                R$ 28,00
                            </strong>

                            <button
                                class="adicionar"
                                data-id="1"
                                data-nome="Sabonete de Maracujá"
                                data-preco="28.00"
                            >
                                +
                            </button>

                        </div>

                    </div>

                </article>


                <!-- coco -->

                <article
                    class="produto"
                    data-nome="coconut"
                    data-pagina="../produtosIndividuais/sab4.php"
                >

                    <div class="produto-imagem imagem-pitanga">
                        <span>🍒</span>
                    </div>

                    <div class="produto-info">

                        <h3>
                            Coconut
                        </h3>

                        <p class="descricao">
                            Rico em vitamina C e antioxidantes
                            para uma pele iluminada.
                        </p>

                        <div class="produto-final">

                            <strong>
                                R$ 30,00
                            </strong>

                            <button
                                class="adicionar"
                                data-id="2"
                                data-nome="Sabonete de Pitanga"
                                data-preco="30.00"
                            >
                                +
                            </button>

                        </div>

                    </div>

                </article>


                <!-- frutas vermelhas -->

                <article
                    class="produto"
                    data-nome="fraguna"
                    data-pagina="../produtosIndividuais/sab1.php"
                >

                    <div class="produto-imagem imagem-laranja">
                        <span>🍊</span>
                    </div>

                    <div class="produto-info">

                        <h3>
                            Fraguna
                        </h3>

                        <p class="descricao">
                            Aroma cítrico revigorante com toque
                            especiado e marcante.
                        </p>

                        <div class="produto-final">

                            <strong>
                                R$ 32,00
                            </strong>

                            <button
                                class="adicionar"
                                data-id="3"
                                data-nome="Sabonete Laranja & Canela"
                                data-preco="32.00"
                            >
                                +
                            </button>

                        </div>

                    </div>

                </article>


                <!-- cítrico -->

                <article
                    class="produto"
                    data-nome="citrico"
                    data-pagina="../produtosIndividuais/sab5.php"
                >

                    <div class="produto-imagem imagem-melancia">
                        <span>🍉</span>
                    </div>

                    <div class="produto-info">

                        <h3>
                            Cítrico
                        </h3>

                        <p class="descricao">
                            Refrescância intensa e aroma frutado
                            para um banho delicioso.
                        </p>

                        <div class="produto-final">

                            <strong>
                                R$ 29,00
                            </strong>

                            <button
                                class="adicionar"
                                data-id="4"
                                data-nome="Sabonete de Melancia"
                                data-preco="29.00"
                            >
                                +
                            </button>

                        </div>

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


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer>

        <p>
            © 2026 Fruit Bubbles — Sabonetes Artesanais
        </p>

    </footer>


    <!-- JAVASCRIPT -->

    <script src="scriptProduto.js"></script>

</body>
</html>