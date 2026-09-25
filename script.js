/* =========================================================
   PESQUISA DE PRODUTOS
========================================================= */

const buscaCabecalho =
    document.getElementById("buscaCabecalho");

const botaoAbrirBusca =
    document.getElementById("botaoAbrirBusca");


/* =========================================================
   NORMALIZAR TEXTO
   Remove acentos e transforma em minúsculo
========================================================= */

function normalizarPesquisa(texto) {

    return texto
        .toLowerCase()
        .trim()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");

}


/* =========================================================
   PESQUISAR PRODUTO
========================================================= */

function pesquisarProdutoCabecalho() {

    if (!buscaCabecalho) {
        return;
    }


    const pesquisa =
        normalizarPesquisa(buscaCabecalho.value);


    /* Se não digitou nada */

    if (pesquisa === "") {

        alert("Digite o nome de um sabonete.");

        buscaCabecalho.focus();

        return;
    }


    /* =====================================================
       PRODUTOS
    ===================================================== */

    const produtos = {

        /* FRUTAS VERMELHAS */

        "frutas vermelhas":
            "produtosIndividuais/sab1.php",

        "frutas vermelha":
            "produtosIndividuais/sab1.php",

        "morango":
            "produtosIndividuais/sab1.php",


        /* MARACUJÁ */

        "maracuja":
            "produtosIndividuais/sab2.php",

        "massageador maracuja":
            "produtosIndividuais/sab2.php",

        "maracuja massageador":
            "produtosIndividuais/sab2.php",


        /* MIRTILO */

        "mirtilo":
            "produtosIndividuais/sab3.php",


        /* COCO */

        "coco":
            "produtosIndividuais/sab4.php",

        "massageador coco":
            "produtosIndividuais/sab4.php",

        "coco massageador":
            "produtosIndividuais/sab4.php",


        /* CÍTRICO */

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


    /* =====================================================
       VERIFICA SE O PRODUTO EXISTE
    ===================================================== */

    const paginaProduto = produtos[pesquisa];


    if (!paginaProduto) {

        alert(
            'Não encontramos o sabonete "' +
            buscaCabecalho.value.trim() +
            '".'
        );

        return;
    }


    /* =====================================================
       DESCOBRIR SE ESTAMOS EM produtosIndividuais
    ===================================================== */

    const estaEmProdutosIndividuais =
        window.location.pathname.includes(
            "/produtosIndividuais/"
        );


    /*
       Se já estivermos dentro da pasta produtosIndividuais,
       não precisamos colocar produtosIndividuais/ novamente.
    */

    if (estaEmProdutosIndividuais) {

        const arquivo =
            paginaProduto.split("/").pop();

        window.location.href = arquivo;

    }

    else {

        window.location.href = paginaProduto;

    }

}


/* =========================================================
   ENTER
========================================================= */

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


/* =========================================================
   CLICAR NA LUPA
========================================================= */

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

const botaoCarrinho = document.getElementById("botaoCarrinho");
const carrinhoLateral = document.getElementById("carrinhoLateral");
const fundoCarrinho = document.getElementById("fundoCarrinho");
const fecharCarrinho = document.getElementById("fecharCarrinho");
const continuarComprando = document.getElementById("continuarComprando");

function abrirCarrinho() {
    carrinhoLateral.classList.add("ativo");
    fundoCarrinho.classList.add("ativo");
    mostrarProdutosCarrinho();

}

function fecharCarrinhoLateral() {
    carrinhoLateral.classList.remove("ativo");
    fundoCarrinho.classList.remove("ativo");

}

function mostrarProdutosCarrinho() {
    const carrinho = JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

    const container = document.getElementById("carrinhoProdutos");

    container.innerHTML = "";

    if (carrinho.length === 0) {
        container.innerHTML = `
            <div class="carrinho-vazio">
                Seu carrinho está vazio.
            </div>
        `;
        document.getElementById("totalCarrinho").textContent = "R$ 0,00";

        return;
    }

    const produtos = {};

    carrinho.forEach(function(nome) {
        if (produtos[nome]) {
            produtos[nome]++;
        } else {
            produtos[nome] = 1;
        }
    });

    let totalGeral = 0;

    Object.keys(produtos).forEach(function(nomeProduto) {
        const quantidade = produtos[nomeProduto];

        const produto = Array.from(
            document.querySelectorAll(".produto")
        ).find(function(item) {

            return item.querySelector("h3")?.textContent.trim()
                === nomeProduto;

        });

        let preco = 0;

        if (produto) {
            preco = parseFloat(
                produto.getAttribute("data-preco")
            ) || 0;
        }

        const totalProduto = preco * quantidade;

        totalGeral += totalProduto;

        const item = document.createElement("div");

        item.classList.add("item-carrinho");

        item.innerHTML = `

            <div class="item-carrinho-topo">

                <h3>
                    ${nomeProduto}
                </h3>

                <div class="item-carrinho-acoes">

                    <div class="item-carrinho-quantidade">

                        <button 
                            type="button"
                            onclick="alterarQuantidade(
                                '${nomeProduto.replace(/'/g, "\\'")}',
                                -1
                            )"
                        >
                            −
                        </button>

                        <span>
                            ${quantidade}
                        </span>

                        <button 
                            type="button"
                            onclick="alterarQuantidade(
                                '${nomeProduto.replace(/'/g, "\\'")}',
                                1
                            )"
                        >
                            +
                        </button>

                    </div>

                    <button 
                        type="button"
                        class="excluir-produto"
                        onclick="excluirProduto(
                            '${nomeProduto.replace(/'/g, "\\'")}'
                        )"
                    >
                        Excluir
                    </button>

                </div>

            </div>


            <div class="item-carrinho-info">

                <span class="preco-unitario">
                    R$ ${preco.toFixed(2).replace(".", ",")}
                </span>

            </div>


            <div class="item-carrinho-total">

                <strong>
                    R$ ${totalProduto.toFixed(2).replace(".", ",")}
                </strong>

            </div>

        `;

        container.appendChild(item);
    });

    document.getElementById("totalCarrinho").textContent =
        "R$ " + totalGeral.toFixed(2).replace(".", ",");

}

function alterarQuantidade(nomeProduto, quantidade) {
    let carrinho =
        JSON.parse(localStorage.getItem("carrinho")) || [];

    if (quantidade === 1) {
        carrinho.push(nomeProduto);
    } else {

        const indice = carrinho.indexOf(nomeProduto);
        if (indice !== -1) {

            carrinho.splice(indice, 1);
        }
    }

    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );

    atualizarContador();
    mostrarProdutosCarrinho();

}

function excluirProduto(nomeProduto) {
    let carrinho =
        JSON.parse(localStorage.getItem("carrinho")) || [];

    carrinho = carrinho.filter(function(nome) {
        return nome !== nomeProduto;
    });

    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );

    atualizarContador();
    mostrarProdutosCarrinho();

}

if (botaoCarrinho) {
    botaoCarrinho.addEventListener("click", function(event) {
        event.preventDefault();
        abrirCarrinho();
    });
}

if (fecharCarrinho) {
    fecharCarrinho.addEventListener("click", function() {
        fecharCarrinhoLateral();
    });
}

if (fundoCarrinho) {
    fundoCarrinho.addEventListener("click", function() {
        fecharCarrinhoLateral();
    });
}

if (continuarComprando) {
    continuarComprando.addEventListener("click", function() {
        fecharCarrinhoLateral();
    });

}

/* =========================================
   MENU MOBILE
========================================= */

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


/* ABRIR PRODUTOS */

if (botaoProdutosMobile) {

    botaoProdutosMobile.addEventListener("click", function() {

        submenuProdutosMobile.classList.toggle("ativo");

        botaoProdutosMobile.classList.toggle("aberto");

    });

}


/*Confirmar exclusão de conta*/

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

// PRODUTOS INDIVIDUAIS

// CARROSSEL DE FOTOS DOS PRODUTO
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

// CONTROLE DE QTD E ADICIONAR AO CARRINHO
document.addEventListener("DOMContentLoaded", function () {

    const menosQtd = document.getElementById("menosQtd");
    const maisQtd = document.getElementById("maisQtd");
    const qtdValor = document.getElementById("qtdValor");
    const botaoComprar = document.getElementById("botaoComprar");

    // Se não estiver em uma página de produto individual, não faz nada.
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

        // Recupera o carrinho atual
        let carrinho =
            JSON.parse(localStorage.getItem("carrinho")) || [];

        // Adiciona a quantidade escolhida
        for (let i = 0; i < quantidade; i++) {
            carrinho.push(nomeProduto);
        }

        // Salva novamente o carrinho
        localStorage.setItem(
            "carrinho",
            JSON.stringify(carrinho)
        );

        // Atualiza o contador do carrinho
        if (typeof atualizarContador === "function") {
            atualizarContador();
        }

        // Feedback visual no botão
        const textoOriginal = botaoComprar.textContent;

        botaoComprar.textContent = "Produto adicionado";
        botaoComprar.classList.add("produto-adicionado");

        setTimeout(function () {
            botaoComprar.textContent = textoOriginal;
            botaoComprar.classList.remove("produto-adicionado");
        }, 2000);

        // Abre o carrinho lateral
        if (typeof abrirCarrinho === "function") {
            abrirCarrinho();
        }
    });

    // Inicializa a quantidade
    atualizarQuantidade();
});