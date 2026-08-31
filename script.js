const campoBusca = document.getElementById("campoPesquisa");
const botaoBusca = document.getElementById("botaoBusca");

function removerAcentos(texto) {
    return texto
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}

function pesquisarProduto() {

    if (!campoBusca) return;

    const pesquisa = removerAcentos(
        campoBusca.value.trim().toLowerCase()
    );

    const produtos = document.querySelectorAll(".produto");

    let encontrou = false;

    produtos.forEach(produto => {

        const nomeProduto = produto.getAttribute("data-nome") || "";

        const nome = removerAcentos(
            nomeProduto.toLowerCase()
        );

        if (pesquisa === "" || nome.includes(pesquisa)) {

            produto.style.display = "";

            encontrou = true;

        } else {

            produto.style.display = "none";

        }

    });

    mostrarMensagemBusca(!encontrou && pesquisa !== "");
}
 
function mostrarMensagemBusca(mostrar) {

    let mensagem = document.getElementById("mensagemBusca");

    if (mostrar) {

        if (!mensagem) {

            mensagem = document.createElement("p");

            mensagem.id = "mensagemBusca";

            mensagem.textContent = "Nenhum produto encontrado.";

            const container =
                document.querySelector(".produtos-scroll");

            if (container) {
                container.appendChild(mensagem);
            }
        }

    } else {

        if (mensagem) { 
            mensagem.remove(); 
        }

    }
}
 
if (botaoBusca) {

    botaoBusca.addEventListener("click", function () {
        pesquisarProduto();
    });

}
 
if (campoBusca) {

    campoBusca.addEventListener("keydown", function(event) {

        if (event.key === "Enter") {

            event.preventDefault();

            pesquisarProduto();

        }

    });
 
    campoBusca.addEventListener("input", function() {

        pesquisarProduto();

    });

}
 
function adicionarCarrinho(nomeProduto, botao) {

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

            <div class="item-carrinho-info">
                <h3>
                    ${nomeProduto}
                </h3>

                <span class="preco-unitario">
                    R$ ${preco.toFixed(2).replace(".", ",")}
                </span>
            </div>

            <div class="item-carrinho-quantidade">

                <button 
                    type="button"
                    onclick="alterarQuantidade('${nomeProduto.replace(/'/g, "\\'")}', -1)"
                >
                    −
                </button>

                <span>
                    ${quantidade}
                </span>

                <button 
                    type="button"
                    onclick="alterarQuantidade('${nomeProduto.replace(/'/g, "\\'")}', 1)"
                >
                    +
                </button>

            </div>

            <div class="item-carrinho-total">
                <strong>
                    R$ ${totalProduto.toFixed(2).replace(".", ",")}
                </strong>

                <button 
                    type="button"
                    class="excluir-produto"
                    onclick="excluirProduto('${nomeProduto.replace(/'/g, "\\'")}')"
                >
                    Excluir
                </button>
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