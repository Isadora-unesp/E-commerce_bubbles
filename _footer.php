<?php
// Arquivo:  footer
$base = $base ?? "";

?>

<!-- Seção: rodapé -->
<footer class="footer-fruit" id="contato">

    <div class="footer-fruit-conteudo">

        <div class="footer-fruit-marca">

            <!-- Logo da marca -->
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

        <!-- Informações da marca -->
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
            <a href="<?= $base ?>sobrenos.php">Sobre nós</a>
        </div>

        <!-- Pessoas que desenvolveram o site -->
        <div class="footer-desenvolvedoras">
            <h3>Desenvolvedoras</h3>

            <ul>
                <li>Bianca Penteado Pinheiro</li>
                <li>Heloysa dos Santos Moraes</li>
                <li>Isabella Meirelles Cury</li>
                <li>Isadora Adorno da Silva</li>
                <li>Lívia Comora Ponga</li>
                <li>Mirella de Oliveira e Quadros</li>
            </ul>
        </div>

    </div>

    <div class="footer-fruit-final">
        <p>Fruit Bubbles — E-commerce 2026</p>
    </div>

</footer>

<button type="button" id="botaoTopo" class="botao-topo" aria-label="Voltar ao topo">↑</button>

<style>
    .botao-topo {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 100;

        width: 44px;
        height: 44px;

        border: none;
        border-radius: 50%;
        background: #fb6666;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s, transform 0.2s;
    }

    .botao-topo.visivel {
        opacity: 1;
        pointer-events: auto;
    }

    .botao-topo:hover {
        transform: translateY(-3px);
    }
</style>

<script>
    (function () {
        const botaoTopo = document.getElementById('botaoTopo');

        window.addEventListener('scroll', function () {
            botaoTopo.classList.toggle('visivel', window.scrollY > 300);
        });

        botaoTopo.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
</script>