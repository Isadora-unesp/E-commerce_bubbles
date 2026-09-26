const buscaCabecalho = document.getElementById("buscaCabecalho");

const botaoAbrirBusca = document.getElementById("botaoAbrirBusca");

function normalizarPesquisa(texto) {

    return texto
        .toLowerCase()
        .trim()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");

}

function pesquisarProdutoCabecalho() {

    if (!buscaCabecalho) {
        return;
    }

    const pesquisa = normalizarPesquisa(buscaCabecalho.value);
 
    if (pesquisa === "") {

        alert("Digite o nome de um sabonete.");

        buscaCabecalho.focus();

        return;
    }
 
    const produtos = {

        "frutas vermelhas":
            "produtosIndividuais/sab1.php",

        "frutas vermelha":
            "produtosIndividuais/sab1.php",

        "morango":
            "produtosIndividuais/sab1.php",

        "maracuja":
            "produtosIndividuais/sab2.php",

        "massageador maracuja":
            "produtosIndividuais/sab2.php",

        "maracuja massageador":
            "produtosIndividuais/sab2.php",

        "coco":
            "produtosIndividuais/sab4.php",

        "massageador coco":
            "produtosIndividuais/sab4.php",

        "coco massageador":
            "produtosIndividuais/sab4.php",

        "citrico":
            "produtosIndividuais/sab5.php",

        "laranja":
            "produtosIndividuais/sab5.php",

        "limao":
            "produtosIndividuais/sab5.php",

        "laranja limao":
            "produtosIndividuais/sab5.php",

        "laranja e limao":
            "produtosIndividuais/sab5.php"

    };
 
    const paginaProduto = produtos[pesquisa];

    if (!paginaProduto) {

        alert(
            'Não encontramos o sabonete "' +
            buscaCabecalho.value.trim() +
            '".'
        );

        return;
    }
 
    const estaEmProdutosIndividuais =
        window.location.pathname.includes(
            "/produtosIndividuais/"
        );
 
    if (estaEmProdutosIndividuais) {

        const arquivo =
            paginaProduto.split("/").pop();

        window.location.href = arquivo;

    }

    else {

        window.location.href = paginaProduto;

    }

}
 
if (buscaCabecalho) {

    buscaCabecalho.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Enter") {

                event.preventDefault();

                pesquisarProdutoCabecalho();

            }

        }
    );

}
 
if (botaoAbrirBusca) {

    botaoAbrirBusca.addEventListener(
        "click",
        pesquisarProdutoCabecalho
    );

}

function adicionarCarrinho(nomeProduto, botao) {

    if (typeof usuarioLogado !== "undefined" && !usuarioLogado) {

        window.location.href = (typeof caminhoBase !== "undefined" ? caminhoBase : "") + "login.php";

        return;
    }

    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    carrinho.push(nomeProduto);

    localStorage.setItem("carrinho", JSON.stringify(carrinho));

    atualizarContador();

    botao.textContent = "Produto adicionado";
    botao.style.backgroundColor = "#718442";
    botao.style.borderColor = "#718442";
    botao.style.color = "#fff";

    setTimeout(function() {

        botao.textContent = "Adicionar ao carrinho";
        botao.style.backgroundColor = "#f86464";
        botao.style.borderColor = "#f86464";
        botao.style.color = "#fff";

    }, 2000);
}


function atualizarContador() {

    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    const contador = document.getElementById("contadorCarrinho");

    if (contador) {
        contador.textContent = carrinho.length;
    }

}

atualizarContador();

/*PÁGINA DO CARRINHO*/
const produtosCarrinhoPagina = {

    "Frutas Vermelhas": {
        preco: 12.50,
        imagem: "img/morango.jpg"
    },

    "Maracujá": {
        preco: 11.90,
        imagem: "img/maracuja.jpg"
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

function moeda(valor) {

    return "R$ " +
        valor
            .toFixed(2)
            .replace(".", ",");

}

function lerCarrinhoPagina() {

    return JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

}

function salvarCarrinhoPagina(carrinho) {

    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );


    atualizarContador();

    renderizarCarrinhoPagina();

}

function alterarQuantidadePagina(
    nomeProduto,
    diferenca
) {

    const carrinho = lerCarrinhoPagina();

    if (diferenca > 0) {

        carrinho.push(nomeProduto);

    }

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
 
function renderizarCarrinhoPagina() {

    const container =
        document.getElementById(
            "carrinhoPaginaProdutos"
        );

    if (!container) {
        return;
    }

    const carrinho =
        lerCarrinhoPagina();

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

        if (subtotal) {
            subtotal.textContent =
                "R$ 0,00";
        }

        if (total) {
            total.textContent =
                "R$ 0,00";
        }

        if (botaoFinalizar) {
            botaoFinalizar.disabled = true;
        }

        return;
    }

    const quantidades = {};

    carrinho.forEach(
        function(nome) {

            quantidades[nome] =
                (quantidades[nome] || 0) + 1;

        }
    );

    let totalGeral = 0;

    Object.keys(quantidades)
        .forEach(
            function(nomeProduto) {
            
                const dados = produtosCarrinhoPagina[nomeProduto];

                if (!dados) {
                    return;
                }

                const quantidade = quantidades[nomeProduto];

                const totalProduto = dados.preco * quantidade;

                totalGeral += totalProduto;

                const item = document.createElement(
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
                                    class="diminuir-quantidade"
                                    aria-label="Diminuir quantidade"
                                >
                                    −
                                </button>

                                <span>
                                    ${quantidade}
                                </span>

                                <button
                                    type="button"
                                    class="aumentar-quantidade"
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

                item
                    .querySelector(
                        ".diminuir-quantidade"
                    )
                    .addEventListener(
                        "click",
                        function() {

                            alterarQuantidadePagina(
                                nomeProduto,
                                -1
                            );

                        }
                    );

                item
                    .querySelector(
                        ".aumentar-quantidade"
                    )
                    .addEventListener(
                        "click",
                        function() {

                            alterarQuantidadePagina(
                                nomeProduto,
                                1
                            );

                        }
                    );

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

    if (subtotal) {

        subtotal.textContent =
            moeda(totalGeral);

    }

    if (total) {

        total.textContent =
            moeda(totalGeral);

    }

    if (botaoFinalizar) {

        botaoFinalizar.disabled =
            totalGeral <= 0;

    }

}

document.addEventListener(
    "DOMContentLoaded",
    function() {

        renderizarCarrinhoPagina();

    }
);

/* MENU MOBILE */

const botaoMenuMobile = document.getElementById("botaoMenuMobile");
const menuLateralMobile = document.getElementById("menuLateralMobile");
const fundoMenuMobile = document.getElementById("fundoMenuMobile");
const fecharMenuMobile = document.getElementById("fecharMenuMobile");

const botaoProdutosMobile = document.getElementById("botaoProdutosMobile");
const submenuProdutosMobile = document.getElementById("submenuProdutosMobile");
 
function abrirMenuMobile() {

    menuLateralMobile.classList.add("ativo");
    fundoMenuMobile.classList.add("ativo");

}
 
function fecharMenuMobileFuncao() {

    menuLateralMobile.classList.remove("ativo");
    fundoMenuMobile.classList.remove("ativo");

}
 
if (botaoMenuMobile) {

    botaoMenuMobile.addEventListener("click", function() {

        abrirMenuMobile();

    });

}
 
if (fecharMenuMobile) {

    fecharMenuMobile.addEventListener("click", function() {

        fecharMenuMobileFuncao();

    });

} 

if (fundoMenuMobile) {

    fundoMenuMobile.addEventListener("click", function() {

        fecharMenuMobileFuncao();

    });

}
 
if (botaoProdutosMobile) {

    botaoProdutosMobile.addEventListener("click", function() {

        submenuProdutosMobile.classList.toggle("ativo");

        botaoProdutosMobile.classList.toggle("aberto");

    });

}
 
document.addEventListener("DOMContentLoaded", function () {

    var linksExclusao = document.querySelectorAll(".confirmar-exclusao");

    linksExclusao.forEach(function (link) {

        link.addEventListener("click", function (evento) {

            var confirmou = confirm("Tem certeza que deseja excluir sua conta? Essa ação não pode ser desfeita.");

            if (!confirmou) {
                evento.preventDefault();
            }

        });

    });

});
 
function iniciarCarrossel() {

    const fotos = document.querySelectorAll(".slide");
    const pontos = document.querySelectorAll(".ponto");
    const botaoAnterior = document.getElementById("slideAnterior");
    const botaoProximo = document.getElementById("slideProximo");

    if (!fotos.length || !pontos.length || !botaoAnterior || !botaoProximo) {
        return;
    }

    let fotoAtual = 0;

    function mostrarFoto(numero) {

        fotoAtual = (numero + fotos.length) % fotos.length;

        fotos.forEach(function (foto, i) {

            foto.classList.toggle(
                "ativo",
                i === fotoAtual
            );

        });

        pontos.forEach(function (ponto, i) {

            ponto.classList.toggle(
                "ativo",
                i === fotoAtual
            );

        });

    }

    botaoAnterior.addEventListener("click", function () {

        mostrarFoto(fotoAtual - 1);

    });

    botaoProximo.addEventListener("click", function () {

        mostrarFoto(fotoAtual + 1);

    });

    pontos.forEach(function (ponto, i) {

        ponto.addEventListener("click", function () {

            mostrarFoto(i);

        });

    });

}

iniciarCarrossel();
 
document.addEventListener("DOMContentLoaded", function () {

    const menosQtd = document.getElementById("menosQtd");
    const maisQtd = document.getElementById("maisQtd");
    const qtdValor = document.getElementById("qtdValor");
    const botaoComprar = document.getElementById("botaoComprar");

    if (!menosQtd || !maisQtd || !qtdValor || !botaoComprar) {
        return;
    }

    let quantidade = parseInt(qtdValor.textContent, 10) || 1;

    function atualizarQuantidade() {
        qtdValor.textContent = quantidade;
        menosQtd.disabled = quantidade <= 1;
    }

    menosQtd.addEventListener("click", function () {
        if (quantidade > 1) {
            quantidade--;
            atualizarQuantidade();
        }
    });

    maisQtd.addEventListener("click", function () {
        quantidade++;
        atualizarQuantidade();
    });

    botaoComprar.addEventListener("click", function () {

        const titulo = document.querySelector(".detalhe-info h1");
        const nomeProduto = titulo
            ? titulo.textContent.trim()
            : "Produto";

        let carrinho =
            JSON.parse(localStorage.getItem("carrinho")) || [];
 
        for (let i = 0; i < quantidade; i++) {
            carrinho.push(nomeProduto);
        }
 
        localStorage.setItem(
            "carrinho",
            JSON.stringify(carrinho)
        );
 
        if (typeof atualizarContador === "function") {
            atualizarContador();
        }
 
        const textoOriginal = botaoComprar.textContent;

        botaoComprar.textContent = "Produto adicionado";
        botaoComprar.classList.add("produto-adicionado");

        setTimeout(function () {
            botaoComprar.textContent = textoOriginal;
            botaoComprar.classList.remove("produto-adicionado");
        }, 2000);
 
    });
 
    atualizarQuantidade();
});