<?php
// Carrega as funções utilitárias do sistema
require_once "../util.php";

// Esta página está dentro de /produtosIndividuais, então o cabeçalho e o
// rodapé precisam de "../" para achar imagens e links da raiz do site
$base = "../";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sabonete Massageador Maracujá | Fruit Bubbles</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="styleSAB.css">
</head>

<body>

    <!-- INCLUSÃO DO CABEÇALHO EM PHP -->
    <?php include_once "../_cabecalho.php"; ?>

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


    <!-- CONTEÚDO PRINCIPAL -->
    <main class="pagina-produto">

        <!-- CAMINHO DA PÁGINA -->
        <nav class="caminho" aria-label="Você está em">

            <a href="../index.php">Início</a>

            <span>/</span>

            <a href="../produtos.php">Produtos</a>

            <span>/</span>

            <span>Sabonete Massageador Maracujá</span>

        </nav>


        <!-- DETALHES DO PRODUTO -->
        <section class="detalhe">

            <!-- CARROSSEL DE FOTOS -->
            <div class="slideshow-coluna">

                <div class="slideshow">

                    <div class="slide ativo">
                        <span class="slide-contador">1 / 3</span>
                        <img src="../img/maracuja.jpg" alt="Sabonete Massageador Maracujá, foto 1">
                    </div>

                    <div class="slide">
                        <span class="slide-contador">2 / 3</span>
                        <img src="../img/maracuja.jpg" alt="Sabonete Massageador Maracujá, foto 2">
                    </div>

                    <div class="slide">
                        <span class="slide-contador">3 / 3</span>
                        <img src="../img/maracuja.jpg" alt="Sabonete Massageador Maracujá, foto 3">
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

                    <span class="subtitulo">SABONETE ARTESANAL</span>

                    <h1>Sabonete Massageador Maracujá</h1>

                    <p class="resumo">
                        Sabonete artesanal com extrato natural de frutas vermelhas.
                        Limpa, perfuma e deixa a pele macia.
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
                <p class="preco">R$ 15,00</p>


                <!-- PESO -->
                <div class="bloco-opcao">

                    <span>Peso</span>

                    <button type="button" class="peso-btn">90 g</button>

                </div>


                <!-- QUANTIDADE -->
                <div class="bloco-opcao">

                    <span>Quantidade</span>

                    <div class="quantidade">

                        <button type="button" id="menosQtd" aria-label="Diminuir quantidade">−</button>

                        <span id="qtdValor">1</span>

                        <button type="button" id="maisQtd" aria-label="Aumentar quantidade">+</button>

                    </div>

                </div>


                <!-- ADICIONAR AO CARRINHO -->
                <button type="button" class="comprar" id="botaoComprar">
                    Adicionar ao carrinho
                </button>

            </div>

        </section>


        <!-- DESCRIÇÃO -->
        <section class="info-card">

            <div class="coluna">

                <h2>Descrição do produto</h2>

                <p>
                    Nosso sabonete Frutas Vermelhas é feito artesanalmente com ingredientes naturais
                    que limpam delicadamente e deixam a pele macia, hidratada e levemente perfumada.
                </p>

                <p>
                    O extrato natural de frutas vermelhas é rico em antioxidantes,
                    trazendo um aroma doce e frutado para o seu dia a dia.
                </p>

                <ul>
                    <li>Limpeza suave e eficaz</li>
                    <li>Hidratação profunda</li>
                    <li>Aroma frutado e adocicado</li>
                    <li>Ideal para todos os tipos de pele</li>
                </ul>

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

                <!-- Frutas Vermelhas -->
                <a href="sab1.php" class="outro-card">
                    <img src="../img/morango.jpg" alt="Sabonete Frutas Vermelhas">
                    <h3>Frutas Vermelhas</h3>
                    <strong>R$ 9,00</strong>
                </a>

                <!-- COCO -->
                <a href="sab4.php" class="outro-card">
                    <img src="../img/coco.jpg" alt="Sabonete Coco">
                    <h3>Coco</h3>
                    <strong>R$ 12,00</strong>
                </a>

                <!-- CÍTRICO -->
                <a href="sab3.php" class="outro-card">
                    <img src="../img/citrico.jpg" alt="Sabonete Cítrico">
                    <h3>Cítrico</h3>
                    <strong>R$ 9,00</strong>
                </a>

            </div>

        </section>

    </main>


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


    <!-- RODAPÉ -->
    <?php include_once "../_footer.php"; ?>


    <!-- JAVASCRIPT (por último, depois de todo o HTML) -->
    <script src="../script.js" defer></script>

</body>

</html>