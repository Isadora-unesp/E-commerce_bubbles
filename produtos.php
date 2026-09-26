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

    <main>
 
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