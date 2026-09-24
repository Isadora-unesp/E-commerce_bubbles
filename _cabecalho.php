<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">

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

    <a href="index.php" class="logo">
        <img src="img/logo2.png" alt="Fruit Bubbles">
    </a>

    <nav class="menu">
        <a href="index.php" class="ativo">Início</a>
        <a href="produtos.php">Produtos</a>
        <a href="ingredientes.php">Ingredientes</a>
        <a href="sobrenos.php">Sobre nós</a>
    </nav>

    <div class="acoes">

        <div class="pesquisa">
            <input
                type="text"
                id="campoPesquisa"
                placeholder="Buscar produtos..."
                autocomplete="off"
            >
            <button type="button" id="botaoAbrirBusca" aria-label="Pesquisar produtos">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                </svg>
            </button>
        </div>

        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>

            <a href="admin.php" class="icone" aria-label="Painel administrativo">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
            </a>

        <?php } ?>

        <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) { ?>
            <a href="perfilUsuario.php" class="icone" aria-label="Minha conta">
        <?php } else { ?>
            <a href="login.php" class="icone" aria-label="Minha conta">
        <?php } ?>
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
            </svg>
        </a>

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