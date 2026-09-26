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
        
        <main class="pagina-carrinho">

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

            <section class="carrinho-conteudo">

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

                    <div
                        id="carrinhoPaginaProdutos"
                        class="carrinho-pagina-produtos"
                    ></div>


                </div>

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

        <script src="script.js"></script>

    </body>

</html>