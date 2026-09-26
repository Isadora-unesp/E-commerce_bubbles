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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sobre Nós | Fruit Bubbles</title>

    <link
        rel="stylesheet"
        href="<?= $base ?>style.css"
    >

    <link
        rel="stylesheet"
        href="<?= $base ?>styleSN.css"
    >

</head>

<body>

<?php include_once "_cabecalho.php"; ?>


<main class="sobre-page">


    <!-- =========================================
         HERO
    ========================================== -->

    <section class="sobre-hero">

        <div class="sobre-hero-conteudo">

            <span class="sobre-etiqueta">
                NOSSO PROJETO
            </span>

            <h1>
                Muito além de um
                <em>trabalho escolar.</em>
            </h1>

            <p>
                A Fruit Bubbles nasceu dentro da escola,
                a partir do desafio de criar um e-commerce
                do zero. Entre ideias, pesquisas, códigos
                e sabonetes, transformamos um projeto em
                uma experiência que tem um pouquinho de
                cada uma de nós.
            </p>

            <a
                href="#nossa-historia"
                class="sobre-botao"
            >
                Conheça nossa história
                <span>↓</span>
            </a>

        </div>

        <div class="sobre-hero-foto">

            <img
                src="<?= $base ?>img/equipe.jpg"
                alt="Equipe Fruit Bubbles"
            >

        </div>

    </section>



    <!-- =========================================
         NOSSA HISTÓRIA
    ========================================== -->

    <section
        class="nossa-historia"
        id="nossa-historia"
    >

        <div class="historia-titulo">

            <span class="sobre-etiqueta">
                COMO TUDO COMEÇOU
            </span>

            <h2>
                Uma ideia que saiu
                <em>da sala de aula.</em>
            </h2>

        </div>


        <div class="historia-texto">

            <p>
                Tudo começou como um projeto escolar:
                nossa turma recebeu a proposta de desenvolver
                uma empresa e criar seu próprio e-commerce.
                Foi então que começamos a pensar no que
                poderíamos produzir, como seria nossa marca
                e de que maneira poderíamos unir criatividade,
                tecnologia e empreendedorismo.
            </p>

            <p>
                Depois de muitas conversas e ideias, chegamos
                aos sabonetes artesanais inspirados em frutas.
                Assim nasceu a <strong>Fruit Bubbles</strong>,
                uma marca criada e desenvolvida por nós,
                desde a identidade visual e os produtos até
                este site que você está acessando agora.
            </p>

        </div>

    </section>

    <!-- =========================================
         O QUE APRENDEMOS
    ========================================== -->

    <section class="aprendizado-section">

        <div class="aprendizado-intro">

            <span class="sobre-etiqueta">
                POR TRÁS DO SITE
            </span>

            <h2>
                Na prática,
                <em>aprendemos fazendo.</em>
            </h2>

            <p>
                Criar a Fruit Bubbles envolveu muito mais
                do que escolher um nome e vender sabonetes.
                Cada área trouxe um desafio diferente e fez
                parte da construção do nosso projeto.
            </p>

        </div>

        <div class="aprendizado-grid">

            <article class="aprendizado-card card-rosa">

                <h3>
                    Criar uma marca
                </h3>

                <p>
                    Pensamos no nome, nas cores, na identidade
                    visual e em como queríamos apresentar a
                    Fruit Bubbles para as pessoas.
                </p>

            </article>

            <article class="aprendizado-card card-verde">

                <h3>
                    Produzir de verdade
                </h3>

                <p>
                    Pesquisamos ingredientes, organizamos a
                    produção e acompanhamos os detalhes para
                    transformar a ideia em um produto real.
                </p>

            </article>

            <article class="aprendizado-card card-lilas">

                <h3>
                    Desenvolver o e-commerce
                </h3>

                <p>
                    O site também faz parte do projeto.
                    Planejamos as páginas, desenvolvemos
                    funcionalidades e trabalhamos para deixar
                    a experiência simples e organizada.
                </p>

            </article>

            <article class="aprendizado-card card-amarelo">

                <h3>
                    Trabalhar em equipe
                </h3>

                <p>
                    Dividimos responsabilidades, tomamos
                    decisões juntas e aprendemos que cada
                    área é importante para fazer uma empresa
                    funcionar.
                </p>

            </article>

        </div>

    </section>



    <!-- =========================================
         PROCESSO
    ========================================== -->

    <section class="processo-section">

        <div class="processo-cabecalho">

            <span class="sobre-etiqueta">
                DO PROJETO AO PRODUTO
            </span>

            <h2>
                Um pouco do nosso
                <em>processo.</em>
            </h2>

            <p>
                Por trás de cada sabonete existem etapas
                que nós mesmas precisamos organizar e
                acompanhar.
            </p>

        </div>


        <div class="processo-etapas">

            <article class="processo-item">

                <h3>
                    Planejamento
                </h3>

                <p>
                    Definimos os produtos, fragrâncias,
                    materiais e tudo o que seria necessário
                    para começar.
                </p>

            </article>


            <article class="processo-item">

                <h3>
                    Produção
                </h3>

                <p>
                    Organizamos os ingredientes e produzimos
                    os sabonetes artesanais que fazem parte
                    da nossa loja.
                </p>

            </article>


            <article class="processo-item">

                <h3>
                    Qualidade
                </h3>

                <p>
                    Conferimos os produtos e os detalhes
                    antes de deixá-los prontos para a venda.
                </p>

            </article>


            <article class="processo-item">

                <h3>
                    Venda
                </h3>

                <p>
                    Organizamos estoque, preços, divulgação
                    e o e-commerce para apresentar nosso
                    trabalho.
                </p>

            </article>

        </div>

    </section>

    <section class="time-equipe-section">

        <div class="time-equipe-cabecalho">

            <h2>
                Prazer, somos
                <em>nós!</em>
            </h2>

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
                        Cuida das finanças, planilhas,
                        custos e organização dos resultados
                        do projeto.
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
                        Organiza os ingredientes e acompanha
                        o processo de produção dos nossos
                        sabonetes.
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
                        Cuida do e-commerce, do estoque,
                        das redes sociais e da parte
                        tecnológica do projeto.
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
                        Ajuda na organização da equipe
                        e no bom funcionamento do trabalho
                        entre todas nós.
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
                        Cuida dos preços, das estratégias
                        de venda e de como nossos produtos
                        chegam aos clientes.
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
                        Acompanha a qualidade dos produtos
                        e ajuda a identificar o que podemos
                        melhorar.
                    </p>

                </div>

            </article>

        </div>

    </section>

<?php include_once "_footer.php"; ?>

<script src="<?= $base ?>script.js"></script>

</body>

</html>