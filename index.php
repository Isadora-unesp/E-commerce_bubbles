<?php
 
include("util.php"); 

$_SESSION["raiz"] = "/loja3a/";

$conn = conecta();

$varSQL = "SELECT id_produto, nome, peso, valor_unitario
           FROM produto
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY id_produto";

$select = $conn->query($varSQL);

$produtosBanco = $select->fetchAll(PDO::FETCH_ASSOC);
 
$imagensPorId = [
    1 => "img/morango.jpg",
    2 => "img/maracuja.jpg",
    3 => "img/coco.jpg",
    5 => "img/citrico.jpg",
];

$paginaPorId = [
    1 => "produtosIndividuais/sab1.php",
    2 => "produtosIndividuais/sab2.php",
    3 => "produtosIndividuais/sab4.php",
    5 => "produtosIndividuais/sab3.php",
];

$produtos = [];

foreach ($produtosBanco as $p) {

    $produtos[] = [
        "nome"   => $p['nome'],
        "peso"   => $p['peso'] . " g",
        "preco"  => (float) $p['valor_unitario'],
        "imagem" => $imagensPorId[$p['id_produto']] ?? "img/produto-padrao.jpg",
        "pagina" => $paginaPorId[$p['id_produto']] ?? "#"
    ];

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <base href="<?= $_SESSION['raiz'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fruit Bubbles | Sabonetes Artesanais</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include '_cabecalho.php'; ?>

    <div class="fundo-pesquisa" id="fundoPesquisa"></div>

    <section class="painel-pesquisa" id="painelPesquisa">

        <div class="pesquisa-topo">

            <div class="pesquisa-campo">

                <input
                    type="text"
                    id="campoPesquisa"
                    placeholder="O que você está buscando?"
                    autocomplete="off"
                >

                <button
                    type="button"
                    id="botaoPesquisar"
                    aria-label="Pesquisar"
                >
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                    </svg>
                </button>

            </div>

            <button
                type="button"
                class="fechar-pesquisa"
                id="fecharPesquisa"
                aria-label="Fechar pesquisa"
            >
                ×
            </button>

        </div>

        <div class="pesquisa-conteudo">

            <p class="pesquisa-instrucao" id="pesquisaInstrucao">
                Digite o nome de um sabonete para pesquisar.
            </p>

            <h2
                class="pesquisa-titulo"
                id="tituloResultado"
            ></h2>

            <div
                class="resultados-pesquisa"
                id="resultadosPesquisa"
            >

                <?php foreach ($produtos as $produto): ?>

                    <div
                        class="produto-pesquisa"
                        data-nome="<?= htmlspecialchars(strtolower($produto['nome'])) ?>"
                    >

                        <div class="produto-pesquisa-imagem">

                            <img
                                src="<?= htmlspecialchars($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                            >

                        </div>

                        <div class="produto-pesquisa-info">

                            <span class="produto-pesquisa-tipo">
                                Fruit Bubbles
                            </span>

                            <h3>
                                <?= htmlspecialchars($produto['nome']) ?>
                            </h3>

                            <span class="produto-pesquisa-peso">
                                <?= htmlspecialchars($produto['peso']) ?>
                            </span>

                            <strong>
                                R$
                                <?= number_format(
                                    $produto['preco'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>
                            </strong>

                            <button
                                type="button"
                                class="produto-pesquisa-comprar"
                                onclick="adicionarCarrinho(
                                    '<?= addslashes($produto['nome']) ?>',
                                    this
                                )"
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <p
                class="nenhum-resultado"
                id="nenhumResultado"
            >
                Nenhum produto encontrado.
            </p>

        </div>

    </section>

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

            <div class="menu-mobile-produtos">

                <button
                    type="button"
                    id="botaoProdutosMobile"
                    class="menu-mobile-item"
                >
                    <span>Produtos</span>
                    <span class="seta">⌄</span>
                </button>

                <div
                    class="submenu-mobile"
                    id="submenuProdutosMobile"
                >

                    <a href="produtos.php">
                        Todos os produtos
                    </a>

                    <a href="produtos.php?categoria=massageador">
                        Sabonete massageador
                    </a>

                    <a href="produtos.php?categoria=barra">
                        Sabonete em barra
                    </a>

                </div>

            </div>

            <a
                href="sobrenos.php"
                class="menu-mobile-item"
            >
                Sobre nós
            </a>

            <?php
            if (
                isset($_SESSION['logado'])
                && $_SESSION['logado'] === true
            ) {
            ?>

                <a
                    href="perfilUsuario.php"
                    class="menu-mobile-item"
                >
                    👤 Perfil
                </a>

            <?php } else { ?>

                <a
                    href="login.php"
                    class="menu-mobile-item"
                >
                    👤 Perfil
                </a>

            <?php } ?>

        </nav>

    </aside>

    <main>

        <section class="hero">

            <div class="hero-texto">

                <span class="subtitulo">
                    FEITO COM FRUTAS. FEITO COM AMOR.
                </span>

                <h1>
                    Seu momento de
                    <em>autocuidado</em>
                    começa aqui
                </h1>

                <p>
                    Sabonetes artesanais com frutas,
                    aromas incríveis e todo o cuidado
                    que sua pele merece.
                </p>

                <a
                    href="produtos.php"
                    class="botao"
                >
                    Conheça nossos produtos
                    <span>→</span>
                </a>

            </div>

            <div class="hero-imagem">

                <img
                    src="img/banner.png"
                    alt="Sabonetes artesanais Fruit Bubbles"
                >

            </div>

            <div class="hero-controles">

                <button>‹</button>

                <div class="hero-pontos">
                    <span class="ativo"></span>
                    <span></span>
                    <span></span>
                </div>

                <button>›</button>

            </div>

        </section>

        <section
            class="produtos"
            id="produtos"
        >

            <div class="titulo-secao">

                <div class="titulo-decoracao"></div>

                <h2>
                    Encontre seu sabonete
                    <em>favorito</em>
                </h2>

                <div class="titulo-decoracao"></div>

            </div>

            <div class="produtos-scroll">

                <?php foreach ($produtos as $indice => $produto): ?>

                    <article
                        class="produto"
                        data-nome="<?= strtolower($produto['nome']) ?>"
                        data-preco="<?= $produto['preco'] ?>"
                        onclick="window.location.href='<?= $produto['pagina'] ?>'"
                        style="cursor: pointer;"
                    >

                        <div class="produto-imagem">

                            <img
                                src="<?= $produto['imagem'] ?>"
                                alt="Sabonete <?= $produto['nome'] ?>"
                            >

                        </div>

                        <div class="produto-info">

                            <h3>
                                <?= $produto['nome'] ?>
                            </h3> 

                            <strong class="produto-preco">

                                R$
                                <?= number_format(
                                    $produto['preco'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                            </strong>

                            <button
                                class="adicionar"
                                data-produto="<?= htmlspecialchars($produto['nome']) ?>"
                                onclick="event.stopPropagation(); adicionarCarrinho(
                                    '<?= htmlspecialchars(
                                        $produto['nome'],
                                        ENT_QUOTES
                                    ) ?>',
                                    this
                                )"
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </section>

        <section class="ingredientes-home">

            <div class="ingredientes-home-topo">

                <span class="subtitulo">
                    O QUE USAMOS NOS SABONETES
                </span>

                <h2>
                    Ingredientes simples, escolhidos
                    para fazer parte de cada produto.
                </h2>

                <p>
                    Nossos sabonetes são produzidos com uma
                    base de ingredientes que ajudam na textura,
                    no aroma, na espuma e na aparência de cada
                    versão.
                </p>

                <a
                    href="produtos.php"
                    class="botao"
                >
                    Conheça os produtos
                    <span>→</span>
                </a>

            </div>


            <div class="ingredientes-beneficios">

                <article class="ingrediente-card">

                    <h3>
                        Glicerina
                    </h3>

                    <p>
                        É a base dos nossos sabonetes e ajuda
                        a manter uma sensação agradável e macia
                        durante o uso.
                    </p>

                </article>


                <article class="ingrediente-card">

                    <h3>
                        Essência
                    </h3>

                    <p>
                        Responsável pelas fragrâncias frutadas
                        que dão identidade a cada sabonete da
                        Fruit Bubbles.
                    </p>

                </article>


                <article class="ingrediente-card">

                    <h3>
                        Extrato glicerinado
                    </h3>

                    <p>
                        Complementa a formulação e é escolhido
                        de acordo com a proposta de cada
                        sabonete.
                    </p>

                </article>

                <article class="ingrediente-card">

                    <h3>
                        Lauril
                    </h3>

                    <p>
                        Ajuda na formação da espuma, deixando
                        o sabonete mais prático e agradável
                        durante o banho.
                    </p>

                </article>

                <article class="ingrediente-card">

                    <h3>
                        Corante
                    </h3>

                    <p>
                        Dá cor aos sabonetes e ajuda a
                        diferenciar visualmente cada fragrância
                        da coleção.
                    </p>

                </article>

                <article class="ingrediente-card">

                    <h3>
                        Álcool de cereais
                    </h3>

                    <p>
                        É utilizado durante o processo de
                        produção para auxiliar no acabamento
                        dos sabonetes.
                    </p>

                </article>

            </div>

        </section>

        <section class="sobre-resumo">

            <div class="sobre-resumo-texto">

                <span class="subtitulo">
                    SOBRE A FRUIT BUBBLES
                </span>

                <h2>
                    Feito por nós,<br>
                    pensado para você.
                </h2>

                <p>
                    Somos a Fruit Bubbles, uma empresa criada
                    a partir de um projeto de e-commerce escolar.
                    Desenvolvemos sabonetes artesanais inspirados
                    em frutas, unindo cuidado, criatividade e
                    carinho em cada produto.
                </p>

                <p>
                    Nosso site foi desenvolvido como parte da
                    nossa experiência de aprendizagem, colocando
                    em prática conhecimentos de tecnologia,
                    empreendedorismo e desenvolvimento web.
                </p>

                <a
                    href="sobrenos.php"
                    class="botao verde"
                >
                    Conheça nossa história
                    <span>→</span>
                </a>

            </div>

            <div class="sobre-resumo-destaque">

                <img
                    src="img/logo.png"
                    alt="Logo Fruit Bubbles"
                >

            </div>

        </section>

    </main>

    <?php include '_footer.php'; ?>


    <script
        src="script.js"
        defer
    ></script>

</body>

</html>