<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base = $base ?? "";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sobre Nós | Fruit Bubbles</title>

    <link rel="stylesheet" href="<?= $base ?>style.css">
    <link rel="stylesheet" href="<?= $base ?>styleSN.css">

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

    <main class="sobre-page">

        <section class="sobre-hero">

            <div class="hero-decor hero-decor-1"></div>

            <div class="hero-decor hero-decor-2"></div>

            <div class="sobre-hero-content">

                <span class="sobre-eyebrow">
                    CONHEÇA NOSSA HISTÓRIA
                </span>

                <h1>
                    Sobre
                    <span>
                        <em>nós</em>
                    </span>
                </h1>

                <p>
                    Somos mais do que sabonetes. Somos o encontro
                    entre a natureza, o cuidado e o prazer de se sentir bem.
                </p>

                <a
                    href="#essencia"
                    class="sobre-btn"
                >
                    Conheça nossa essência

                    <span>
                        ↓
                    </span>
                </a>

            </div>

        </section>


        <section
            class="essencia-section"
            id="essencia"
        >

            <div class="essencia-image">

                <img
                    src="<?= $base ?>img/essencia.jpg"
                    alt="Produtos Fruit Bubbles"
                >

            </div>

            <div class="essencia-content">

                <span class="section-label">
                    • NOSSA ESSÊNCIA
                </span>

                <h2>
                    O que nos
                    <span class="titulo-coral">
                        <em>move</em>
                    </span>
                </h2>

                <p>
                    Acreditamos que o autocuidado é um ato de amor.
                    Por isso, criamos sabonetes artesanais que unem
                    ingredientes naturais, fragrâncias inesquecíveis
                    e o frescor das frutas, transformando o simples
                    em algo especial.
                </p>

                <p class="essencia-destaque">
                    Porque cuidar de você também é natural.
                </p>

            </div>


            <div class="mvv-container">

                <div class="mvv-card missao-card">

                    <div class="mvv-conteudo">

                        <span class="mvv-label">
                            NOSSO PROPÓSITO
                        </span>

                        <h3 class="titulo-missao">
                            Missão
                        </h3>

                        <p>
                            Criar experiências de autocuidado através
                            de sabonetes artesanais que valorizam a
                            natureza, o bem-estar e pequenos momentos
                            de prazer no dia a dia.
                        </p>

                    </div>

                </div>


                <div class="mvv-card visao-card">

                    <div class="mvv-conteudo">

                        <span class="mvv-label">
                            ONDE QUEREMOS CHEGAR
                        </span>

                        <h3 class="titulo-visao">
                            Visão
                        </h3>

                        <p>
                            Ser uma marca reconhecida por transformar
                            o banho em uma experiência leve, especial
                            e cheia de personalidade.
                        </p>

                    </div>

                </div>


                <div class="mvv-card valores-card">

                    <div class="mvv-conteudo">

                        <span class="mvv-label">
                            O QUE ACREDITAMOS
                        </span>

                        <h3 class="titulo-valores">
                            Valores
                        </h3>

                        <ul>

                            <li>
                                Cuidado
                            </li>

                            <li>
                                Naturalidade
                            </li>

                            <li>
                                Criatividade
                            </li>

                            <li>
                                Qualidade
                            </li>

                            <li>
                                Afeto
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </section>


        <section class="processo-section">

            <div class="processo-decor"></div>

            <div class="processo-intro">

                <span class="section-label">
                    • NOSSO PROCESSO
                </span>

                <h2>

                    <span class="processo-verde">
                        <em>Do fruto</em>
                    </span>

                    <span class="processo-coral">
                        <em>ao seu banho</em>
                    </span>

                </h2>

                <p>
                    Cada sabonete nasce de um processo cuidadoso,
                    pensado para transformar ingredientes selecionados
                    em um momento único de bem-estar.
                </p>

                <a
                    href="#"
                    class="sobre-btn processo-btn"
                >
                    Conheça nosso processo

                    <span>
                        →
                    </span>
                </a>

            </div>


            <div class="processo-etapas">

                <div class="processo-item">

                    <div class="processo-numero">
                        01
                    </div>

                    <h4>
                        Seleção dos ingredientes
                    </h4>

                    <p>
                        Escolhemos cuidadosamente cada ingrediente
                        que fará parte dos nossos sabonetes.
                    </p>

                </div>


                <div class="processo-item">

                    <div class="processo-numero processo-numero-lilas">
                        02
                    </div>

                    <h4>
                        Produção artesanal
                    </h4>

                    <p>
                        Cada sabonete é produzido com cuidado,
                        atenção e dedicação em cada etapa.
                    </p>

                </div>


                <div class="processo-item">

                    <div class="processo-numero processo-numero-verde">
                        03
                    </div>

                    <h4>
                        Cura e qualidade
                    </h4>

                    <p>
                        Revisamos cada detalhe para garantir
                        qualidade antes que o produto chegue até você.
                    </p>

                </div>


                <div class="processo-item">

                    <div class="processo-numero processo-numero-lilas">
                        04
                    </div>

                    <h4>
                        Seu momento de bem-estar
                    </h4>

                    <p>
                        O resultado chega até você para transformar
                        um simples banho em um momento especial.
                    </p>

                </div>

            </div>

        </section>


        <section class="time-equipe-section">

            <div class="time-equipe-cabecalho">

                <span class="section-label">
                    • QUEM ESTÁ POR TRÁS
                </span>

                <h2>
                    <em>Nosso time</em>
                </h2>

                <p>
                    Por trás de cada sabonete existe um time apaixonado
                    por criatividade, cuidado e pelo desejo de transformar
                    pequenos momentos em experiências especiais.
                </p>

            </div>


            <div class="time-cards">

                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/bianca.png"
                            alt="Foto de Bianca Penteado"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente financeiro
                        </span>

                        <h3>
                            Bianca Penteado
                        </h3>

                        <p>
                            Controle das finanças, tabelas,
                            planilhas e lucros.
                        </p>

                    </div>

                </article>


                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/time/livia.jpg"
                            alt="Foto de Lívia Comora"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente de produção
                        </span>

                        <h3>
                            Lívia Comora
                        </h3>

                        <p>
                            Ingredientes, como fazer
                            e supervisão da produção.
                        </p>

                    </div>

                </article>


                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/time/isadora.jpg"
                            alt="Foto de Isadora Adorno"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente de informática
                        </span>

                        <h3>
                            Isadora Adorno
                        </h3>

                        <p>
                            Controle de estoque, sites,
                            redes sociais e relatórios.
                        </p>

                    </div>

                </article>


                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/time/mirella.jpg"
                            alt="Foto de Mirella Quadros"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente de recursos humanos
                        </span>

                        <h3>
                            Mirella Quadros
                        </h3>

                        <p>
                            Garantir a paz e a harmonia
                            da equipe.
                        </p>

                    </div>

                </article>


                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/time/isabella.jpg"
                            alt="Foto de Isabella Cury"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente de vendas
                        </span>

                        <h3>
                            Isabella Cury
                        </h3>

                        <p>
                            Cuidar dos preços, promoções
                            e canais de vendas.
                        </p>

                    </div>

                </article>


                <article class="time-card">

                    <div class="time-card-foto">

                        <img
                            src="<?= $base ?>img/time/heloysa.jpg"
                            alt="Foto de Heloysa Moraes"
                        >

                    </div>

                    <div class="time-card-info">

                        <span class="time-card-cargo">
                            Gerente de qualidade
                        </span>

                        <h3>
                            Heloysa Moraes
                        </h3>

                        <p>
                            Garantir os padrões
                            e buscar melhorias.
                        </p>

                    </div>

                </article>

            </div>

        </section>

    </main>

    <?php include_once "_footer.php"; ?>


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

    <script src="<?= $base ?>script.js"></script>

</body>

</html>