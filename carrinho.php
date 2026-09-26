<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base = "";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Revise os produtos do seu carrinho Fruit Bubbles."
    >

    <title>Carrinho | Fruit Bubbles</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="carrinho.css">

</head>


<body>


<?php include "_cabecalho.php"; ?>


<!-- =====================================================
     MENU MOBILE
===================================================== -->

<div
    class="fundo-menu-mobile"
    id="fundoMenuMobile"
></div>


<aside
    class="menu-lateral-mobile"
    id="menuLateralMobile"
>

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

        <a
            href="index.php"
            class="menu-mobile-item"
        >
            Início
        </a>


        <a
            href="produtos.php"
            class="menu-mobile-item"
        >
            Produtos
        </a>


        <a
            href="ingredientes.php"
            class="menu-mobile-item"
        >
            Ingredientes
        </a>


        <a
            href="sobrenos.php"
            class="menu-mobile-item"
        >
            Sobre nós
        </a>


        <?php
        if (
            isset($_SESSION['logado']) &&
            $_SESSION['logado'] === true
        ) {
        ?>

            <a
                href="perfilUsuario.php"
                class="menu-mobile-item"
            >
                👤 Perfil
            </a>

        <?php
        } else {
        ?>

            <a
                href="login.php"
                class="menu-mobile-item"
            >
                👤 Perfil
            </a>

        <?php
        }
        ?>

    </nav>

</aside>



<!-- =====================================================
     PÁGINA DO CARRINHO
===================================================== -->

<main class="pagina-carrinho">


    <!-- HERO -->

    <section class="carrinho-hero">

        <span class="carrinho-eyebrow">
            SEU PEDIDO
        </span>

        <h1>
            Meu <em>carrinho</em>
        </h1>

        <p>
            Confira seus sabonetes, ajuste as quantidades
            e revise o valor do pedido antes de continuar.
        </p>

    </section>



    <!-- CONTEÚDO -->

    <section class="carrinho-conteudo">


        <!-- =============================================
             PRODUTOS
        ============================================== -->

        <div class="carrinho-lista-area">


            <div class="carrinho-lista-topo">

                <div>

                    <h2>
                        Seus produtos
                    </h2>

                </div>


                <a
                    href="produtos.php"
                    class="link-continuar"
                >
                    + Continuar comprando
                </a>

            </div>



            <!--
                Os produtos do localStorage serão
                colocados aqui pelo JavaScript.
            -->

            <div
                id="carrinhoPaginaProdutos"
                class="carrinho-pagina-produtos"
            ></div>


        </div>



        <!-- =============================================
             RESUMO DO PEDIDO
        ============================================== -->

        <aside class="resumo-pedido">

            <h2>
                Resumo do pedido
            </h2>



            <div class="resumo-linha">

                <span>
                    Subtotal
                </span>

                <strong id="subtotalCarrinhoPagina">
                    R$ 0,00
                </strong>

            </div>



            <div class="resumo-linha">

                <span>
                    Entrega
                </span>

                <strong>
                    RETIRADA NO CTI
                </strong>

            </div>



            <div class="resumo-divisor"></div>



            <div class="resumo-total">

                <div>

                    <span>
                        Total
                    </span>

                    <small>
                        Valor dos produtos
                    </small>

                </div>


                <strong id="totalCarrinhoPagina">
                    R$ 0,00
                </strong>

            </div>

            <button
                type="button"
                class="botao-finalizar-pedido"
                id="botaoFinalizarPedido"
            >
                Finalizar reserva
            </button>

            <a
                href="produtos.php"
                class="botao-voltar-produtos"
            >
                Continuar comprando
            </a>

        </aside>

    </section>

</main>



<?php include "_footer.php"; ?>



<!-- =====================================================
     CARRINHO LATERAL
===================================================== -->

<div
    class="fundo-carrinho"
    id="fundoCarrinho"
></div>


<aside
    class="carrinho-lateral"
    id="carrinhoLateral"
>


    <div class="carrinho-cabecalho">

        <h2>
            Seu carrinho
        </h2>


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
    ></div>



    <div class="carrinho-rodape">


        <div class="carrinho-total">

            <span>
                Total:
            </span>

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
            onclick="fecharCarrinhoLateral()"
        >
            Ver carrinho completo
        </button>


    </div>


</aside>



<!-- =====================================================
     JAVASCRIPT PRINCIPAL
===================================================== -->

<script src="script.js"></script>



<!-- =====================================================
     JAVASCRIPT DA PÁGINA DO CARRINHO
===================================================== -->

<script>


/* =========================================================
   DADOS DOS PRODUTOS
========================================================= */

const produtosCarrinhoPagina = {


    "Frutas Vermelhas": {

        preco: 12.50,

        imagem: "img/morango.jpg"

    },


    "Maracujá": {

        preco: 11.90,

        imagem: "img/maracuja.jpg"

    },


    "Mirtilo": {

        preco: 13.20,

        imagem: "img/mirtilo.jpg"

    },


    "Cítrico": {

        preco: 10.80,

        imagem: "img/citrico.jpg"

    },


    "Coco": {

        preco: 10.50,

        imagem: "img/coco.jpg"

    }


};



/* =========================================================
   FORMATAR DINHEIRO
========================================================= */

function moeda(valor) {

    return "R$ " +
        valor
            .toFixed(2)
            .replace(".", ",");

}



/* =========================================================
   PEGAR CARRINHO
========================================================= */

function lerCarrinhoPagina() {

    return JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

}



/* =========================================================
   SALVAR CARRINHO
========================================================= */

function salvarCarrinhoPagina(carrinho) {


    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );


    if (
        typeof atualizarContador === "function"
    ) {

        atualizarContador();

    }


    renderizarCarrinhoPagina();

}



/* =========================================================
   ALTERAR QUANTIDADE
========================================================= */

function alterarQuantidadePagina(
    nomeProduto,
    diferenca
) {


    const carrinho =
        lerCarrinhoPagina();


    /* AUMENTAR */

    if (diferenca > 0) {

        carrinho.push(nomeProduto);

    }


    /* DIMINUIR */

    else {

        const indice =
            carrinho.indexOf(nomeProduto);


        if (indice !== -1) {

            carrinho.splice(
                indice,
                1
            );

        }

    }


    salvarCarrinhoPagina(
        carrinho
    );

}



/* =========================================================
   EXCLUIR PRODUTO
========================================================= */

function excluirProdutoPagina(
    nomeProduto
) {


    const carrinho =
        lerCarrinhoPagina()
            .filter(
                function(nome) {

                    return nome !== nomeProduto;

                }
            );


    salvarCarrinhoPagina(
        carrinho
    );

}



/* =========================================================
   MOSTRAR PRODUTOS
========================================================= */

function renderizarCarrinhoPagina() {


    const carrinho =
        lerCarrinhoPagina();


    const container =
        document.getElementById(
            "carrinhoPaginaProdutos"
        );


    const subtotal =
        document.getElementById(
            "subtotalCarrinhoPagina"
        );


    const total =
        document.getElementById(
            "totalCarrinhoPagina"
        );


    const botaoFinalizar =
        document.getElementById(
            "botaoFinalizarPedido"
        );


    container.innerHTML = "";



    /* =====================================================
       CARRINHO VAZIO
    ===================================================== */

    if (carrinho.length === 0) {


        container.innerHTML = `

            <div class="carrinho-pagina-vazio">

                <div class="vazio-icone">
                    ○
                </div>

                <h3>
                    Seu carrinho está vazio
                </h3>

                <p>
                    Escolha seus sabonetes favoritos
                    para começar seu pedido.
                </p>

                <a href="produtos.php">
                    Conhecer produtos
                </a>

            </div>

        `;


        subtotal.textContent =
            "R$ 0,00";


        total.textContent =
            "R$ 0,00";


        botaoFinalizar.disabled = true;

        return;

    }


    /* =====================================================
       CONTAR QUANTIDADES
    ===================================================== */

    const quantidades = {};


    carrinho.forEach(
        function(nome) {


            quantidades[nome] =
                (quantidades[nome] || 0)
                + 1;


        }
    );



    let totalGeral = 0;



    /* =====================================================
       CRIAR PRODUTOS
    ===================================================== */

    Object.keys(
        quantidades
    ).forEach(
        function(nomeProduto) {


            const quantidade =
                quantidades[nomeProduto];


            const dados =
                produtosCarrinhoPagina[
                    nomeProduto
                ] || {

                    preco: 0,

                    imagem:
                        "img/logo2.png"

                };


            const totalProduto =
                dados.preco *
                quantidade;


            totalGeral +=
                totalProduto;



            const item =
                document.createElement(
                    "article"
                );


            item.className =
                "produto-carrinho-pagina";



            item.innerHTML = `


                <div class="produto-carrinho-imagem">

                    <img
                        src="${dados.imagem}"
                        alt="${nomeProduto}"
                    >

                </div>



                <div class="produto-carrinho-dados">


                    <span class="produto-carrinho-tipo">

                        SABONETE ARTESANAL

                    </span>


                    <h3>

                        ${nomeProduto}

                    </h3>


                    <span class="produto-carrinho-preco">

                        ${moeda(dados.preco)}
                        cada

                    </span>



                    <div class="produto-carrinho-acoes">


                        <div class="quantidade-pagina">


                            <button
                                type="button"
                                aria-label="Diminuir quantidade"
                            >
                                −
                            </button>


                            <span>

                                ${quantidade}

                            </span>


                            <button
                                type="button"
                                aria-label="Aumentar quantidade"
                            >
                                +
                            </button>


                        </div>



                        <button
                            type="button"
                            class="excluir-pagina"
                        >

                            Excluir

                        </button>


                    </div>


                </div>



                <div class="produto-carrinho-subtotal">


                    <span>
                        Subtotal
                    </span>


                    <strong>

                        ${moeda(totalProduto)}

                    </strong>


                </div>


            `;



            /* =============================================
               BOTÕES + E -
            ============================================== */


            const botoesQuantidade =
                item.querySelectorAll(
                    ".quantidade-pagina button"
                );



            /* MENOS */

            botoesQuantidade[0]
                .addEventListener(
                    "click",
                    function() {


                        alterarQuantidadePagina(
                            nomeProduto,
                            -1
                        );


                    }
                );



            /* MAIS */

            botoesQuantidade[1]
                .addEventListener(
                    "click",
                    function() {


                        alterarQuantidadePagina(
                            nomeProduto,
                            1
                        );


                    }
                );



            /* EXCLUIR */

            item
                .querySelector(
                    ".excluir-pagina"
                )
                .addEventListener(
                    "click",
                    function() {


                        excluirProdutoPagina(
                            nomeProduto
                        );


                    }
                );



            container.appendChild(
                item
            );


        }
    );



    /* =====================================================
       TOTAL
    ===================================================== */


    subtotal.textContent =
        moeda(totalGeral);


    total.textContent =
        moeda(totalGeral);



/* =========================================================
   INICIAR
========================================================= */

renderizarCarrinhoPagina();


</script>


</body>

</html>