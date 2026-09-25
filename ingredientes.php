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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Conheça os sabonetes artesanais Fruit Bubbles e as etapas de preparo de cada produto.">
	<title>Sabonetes e preparo | Fruit Bubbles</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="styleSN.css">
	<link rel="stylesheet" href="ingredientes.css">
</head>

<body>
	<?php include '_cabecalho.php'; ?>

	<div class="fundo-menu-mobile" id="fundoMenuMobile"></div>
	<aside class="menu-lateral-mobile" id="menuLateralMobile">
		<div class="menu-mobile-cabecalho">
			<h2>Menu</h2>
			<button type="button" id="fecharMenuMobile" aria-label="Fechar menu">×</button>
		</div>
		<nav class="menu-mobile-itens">
			<a href="index.php" class="menu-mobile-item">Início</a>
			<div class="menu-mobile-produtos">
				<button type="button" id="botaoProdutosMobile" class="menu-mobile-item">
					<span>Produtos</span><span class="seta">⌄</span>
				</button>
				<div class="submenu-mobile" id="submenuProdutosMobile">
					<a href="produtos.php">Todos os produtos</a>
					<a href="produtos.php?categoria=massageador">Sabonete massageador</a>
					<a href="produtos.php?categoria=barra">Sabonete em barra</a>
				</div>
			</div>
			<a href="ingredientes.php" class="menu-mobile-item ativo-mobile">Ingredientes</a>
			<a href="sobrenos.php" class="menu-mobile-item">Sobre nós</a>
		</nav>
	</aside>

	<main class="ingredientes-page">
		<section class="saboes-hero">
			<div class="saboes-hero-texto">
				<span class="saboes-eyebrow">SABONETES ARTESANAIS BUBBLES</span>
				<h1>Pequenos momentos,<br><em>mais especiais.</em></h1>
				<p>Na Bubbles, acreditamos que os pequenos momentos de autocuidado podem tornar o dia mais especial. Por isso, desenvolvemos sabonetes artesanais que combinam aromas agradáveis, cuidado e uma apresentação delicada.</p>
				<p>Nossas versões de 90 g e 120 g foram pensadas para tornar sua rotina ainda mais especial.</p>
				<a class="saboes-link" href="#ingredientes">Conheça a composição e o processo <span aria-hidden="true">↓</span></a>
			</div>
			<figure class="saboes-hero-foto">
				<img src="img/sabonete-destaque.jpg" alt="Sabonetes artesanais">
			</figure>
		</section>

		<section class="saboes-produtos" id="nossos-sabonetes">
			<div class="saboes-cabecalho">
				<span class="saboes-eyebrow">DOIS TAMANHOS, O MESMO CUIDADO</span>
				<h2>Conheça nossos <em>sabonetes</em></h2>
				<p>Uma opção delicada para cada momento da sua rotina.</p>
			</div>
			<div class="saboes-produtos-grid">
				<article class="sabao-card sabao-card-compacto">
					<div class="sabao-card-foto"><img src="img/sabonete-foto-2.jpg" alt="Sabonetes artesanais em barra"></div>
					<div class="sabao-card-info">
						<span class="sabao-tamanho">90 g · NOSSA VERSÃO COMPACTA</span>
						<h3>Um carinho para levar com você</h3>
						<p>Uma opção prática e delicada para quem procura um sabonete artesanal em tamanho menor.</p>
						<ul>
							<li>Base glicerinada</li>
							<li>Aroma definido pela essência escolhida</li>
							<li>Formato produzido em molde</li>
							<li>Embalagem com identificação da marca</li>
						</ul>
					</div>
				</article>
				<article class="sabao-card sabao-card-especial">
					<div class="sabao-card-foto"><img src="img/sabonete-foto-3.jpg" alt="Sabonete artesanal em barra"></div>
					<div class="sabao-card-info">
						<span class="sabao-tamanho">120 g · NOSSA VERSÃO ESPECIAL</span>
						<h3>Um momento ainda mais completo</h3>
						<p>Uma versão maior, com a possibilidade de incluir uma esponja vegetal que complementa a apresentação do produto.</p>
						<ul>
							<li>Base glicerinada</li>
							<li>Aroma definido pela essência escolhida</li>
							<li>Formato produzido em molde massageador</li>
							<li>Possibilidade de incluir esponja vegetal, conforme a composição do produto</li>
						</ul>
					</div>
				</article>
			</div>
		</section>

		<section class="saboes-ingredientes" id="ingredientes">
			<div class="ingredientes-intro">
				<span class="saboes-eyebrow">O QUE FAZ PARTE DA FÓRMULA</span>
				<h2>Conheça os <em>ingredientes</em></h2>
				<p>Nossos sabonetes são produzidos com ingredientes selecionados para compor sua fórmula, proporcionando características como aroma, cor e textura.</p>
			</div>
			<div class="ingredientes-lista" role="table" aria-label="Ingredientes e suas funções">
				<div class="ingredientes-linha ingredientes-titulo" role="row"><span role="columnheader">Ingrediente</span><span role="columnheader">O que é e para que serve</span></div>
				<div class="ingredientes-linha" role="row"><strong>Glicerina</strong><span>Componente da base utilizada na fabricação do sabonete.</span></div>
				<div class="ingredientes-linha" role="row"><strong>Essência</strong><span>Responsável por proporcionar o aroma.</span></div>
				<div class="ingredientes-linha" role="row"><strong>Corante</strong><span>Utilizado para dar cor ao produto.</span></div>
				<div class="ingredientes-linha" role="row"><strong>Extrato glicerinado</strong><span>Ingrediente utilizado na formulação.</span></div>
				<div class="ingredientes-linha" role="row"><strong>Lauril</strong><span>Componente que auxilia na formação de espuma.</span></div>
				<div class="ingredientes-linha" role="row"><strong>Esponja vegetal</strong><span>Material complementar que pode acompanhar o modelo de 120 g.</span></div>
				<p class="ingredientes-observacao">Os ingredientes e suas quantidades devem ser confirmados conforme a fórmula final de cada sabonete.</p>
			</div>
		</section>

		<section class="saboes-processo" id="preparo">
			<div class="saboes-cabecalho">
				<span class="saboes-eyebrow">DO PREPARO À EMBALAGEM</span>
				<h2>Como nossos sabonetes <em>são feitos?</em></h2>
				<p>Cada sabonete passa por etapas de produção que transformam os ingredientes em um produto pronto para ser embalado.</p>
			</div>
			<div class="processo-grid">
				<article class="processo-etapa">
					<img src="img/sabonete-maracuja.jpg" alt="Preparo de sabonete artesanal de maracujá">
					<div><span>01</span><h3>Preparação</h3><p>Separamos e preparamos a base glicerinada e os demais ingredientes.</p></div>
				</article>
				<article class="processo-etapa">
					<img src="img/sabonete-instagram.jpg" alt="Sabonetes artesanais">
					<div><span>02</span><h3>Formulação</h3><p>Adicionamos os ingredientes e o aroma de acordo com a fórmula escolhida.</p></div>
				</article>
				<article class="processo-etapa">
					<img src="img/sabonete-luralai.jpg" alt="Cosmética sólida artesanal">
					<div><span>03</span><h3>Modelagem</h3><p>Colocamos a mistura nos moldes que dão forma aos sabonetes.</p></div>
				</article>
				<article class="processo-etapa processo-finalizacao">
					<img src="img/sabonete-ecoburbujas.jpg" alt="Sabonetes artesanais prontos">
					<div><h3>Finalização</h3><p>Após o endurecimento, os sabonetes são desenformados, embalados e identificados.</p></div>
				</article>
			</div>
		</section>

		<section class="saboes-conservacao">
			<div class="conservacao-titulo">
				<span class="saboes-eyebrow">UM CUIDADO QUE CONTINUA</span>
				<h2>Como conservar<br>seu sabonete?</h2>
			</div>
			<ul class="conservacao-lista">
				<li>Mantenha-o em local seco e arejado quando não estiver em uso.</li>
				<li>Utilize uma saboneteira que permita o escoamento da água.</li>
				<li>Evite deixá-lo em contato constante com água.</li>
				<li>Armazene-o longe de calor excessivo e da luz solar direta.</li>
			</ul>
		</section>

		<section class="saboes-mensagem">
			<span class="saboes-aspas" aria-hidden="true">“</span>
			<p>Na Bubbles, cada detalhe importa. Nossos sabonetes foram pensados para trazer um toque especial à sua rotina, com aromas agradáveis e uma apresentação feita com carinho.</p>
			<strong>Obrigada por escolher a Bubbles!</strong>
		</section>
	</main>

	<?php include '_footer.php'; ?>
	<script src="script.js" defer></script>
</body>

</html>
