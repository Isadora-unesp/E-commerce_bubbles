<?php
// Prefixo dos caminhos: "" nas páginas da raiz, "../" nas páginas de subpastas.
$base = $base ?? "";
?>

<footer class="footer-fruit" id="contato">

    <div class="footer-fruit-conteudo">

        <div class="footer-fruit-marca">

            <div class="footer-fruit-logo">

                <span class="footer-bolha b1"></span>
                <span class="footer-bolha b2"></span>
                <span class="footer-bolha b3"></span>
                <span class="footer-bolha b4"></span>

                <span class="footer-fruit-palavra">
                    Fruit
                </span>

                <span class="footer-bubbles-palavra">
                    Bubbles
                </span>

            </div>

        </div>

        <div class="footer-fruit-info">

            <p>
                Sabonetes artesanais feitos com carinho,
                fragrâncias frutadas e ingredientes selecionados
                para transformar seu banho em um momento especial.
            </p>

            <div class="footer-fruit-redes">
                <a href="https://www.instagram.com/fruit.bubbles_ltda/">Instagram</a>
            </div>

        </div>

        <div class="footer-fruit-nav">
            <h3>Navegação</h3>
            <a href="<?= $base ?>index.php">Início</a>
            <a href="<?= $base ?>produtos.php">Produtos</a>
            <a href="<?= $base ?>ingredientes.php">Ingredientes</a>
            <a href="<?= $base ?>sobrenos.php">Sobre nós</a>
        </div>

    </div>

    <div class="footer-fruit-final">
        <p>2026 Fruit Bubbles — E-commerce.</p>
    </div>

</footer>