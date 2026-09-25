<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
$base = $base ?? "";

/* Descobre qual página está aberta */
$paginaAtual = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>

<header class="header">

    <!-- BOTÃO DO MENU MOBILE -->
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


    <!-- LOGO -->
    <a href="<?= $base ?>index.php" class="logo">
        <img src="<?= $base ?>img/logo2.png" alt="Fruit Bubbles">
    </a>


    <!-- MENU -->
    <nav class="menu">

        <a
            href="<?= $base ?>index.php"
            class="<?= $paginaAtual === 'index.php' ? 'ativo' : '' ?>"
        >
            Início
        </a>

        <a
            href="<?= $base ?>produtos.php"
            class="<?= $paginaAtual === 'produtos.php' ? 'ativo' : '' ?>"
        >
            Produtos
        </a>

        <a
            href="<?= $base ?>ingredientes.php"
            class="<?= $paginaAtual === 'ingredientes.php' ? 'ativo' : '' ?>"
        >
            Ingredientes
        </a>

        <a
            href="<?= $base ?>sobrenos.php"
            class="<?= $paginaAtual === 'sobrenos.php' ? 'ativo' : '' ?>"
        >
            Sobre nós
        </a>

    </nav>


    <!-- AÇÕES -->
    <div class="acoes">

        <!-- BARRA DE PESQUISA -->
        <div class="pesquisa">

            <input
                type="text"
                id="buscaCabecalho"
                placeholder="Buscar sabonete..."
                autocomplete="off"
                aria-label="Buscar sabonete"
            >

            <button
                type="button"
                id="botaoAbrirBusca"
                aria-label="Pesquisar sabonete"
            >
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                </svg>
            </button>

        </div>


        <!-- ADMIN -->
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>

            <a
                href="<?= $base ?>admin.php"
                class="icone"
                aria-label="Painel administrativo"
            >
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
            </a>

        <?php } ?>


        <!-- PERFIL -->
        <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) { ?>

            <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) { ?>

                <a
                    href="<?= $base ?>perfilUsuario.php"
                    class="icone"
                    aria-label="Minha conta"
                >

            <?php } else { ?>

                <a
                    href="<?= $base ?>login.php"
                    class="icone"
                    aria-label="Minha conta"
                >

            <?php } ?>

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                </svg>

            </a>

        <?php } ?>

        <!-- CARRINHO -->
        <button
            type="button"
            class="carrinho"
            id="botaoCarrinho"
            aria-label="Carrinho"
        >
            <svg viewBox="0 0 24 24">
                <path d="M3 4h2l2.5 11h10L20 7H6"></path>
                <circle cx="9" cy="19" r="1.5"></circle>
                <circle cx="17" cy="19" r="1.5"></circle>
            </svg>

            <span id="contadorCarrinho">0</span>
        </button>

    </div>

</header>