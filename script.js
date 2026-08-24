// =========================
// BUSCA DE PRODUTOS
// =========================

const campoBusca = document.getElementById("campoBusca");
const botaoBusca = document.getElementById("botaoBusca");

function pesquisarProduto() {

    const pesquisa = campoBusca.value
        .trim()
        .toLowerCase();

    const produtos = document.querySelectorAll(".produto");

    let encontrou = false;

    produtos.forEach(produto => {

        const nome = produto
            .getAttribute("data-nome")
            .toLowerCase();

        if (nome.includes(pesquisa)) {

            produto.style.display = "";

            encontrou = true;

        } else {

            produto.style.display = "none";

        }

    });

    mostrarMensagemBusca(!encontrou && pesquisa !== "");
}


// =========================
// MENSAGEM DE PRODUTO NÃO ENCONTRADO
// =========================

function mostrarMensagemBusca(mostrar) {

    let mensagem = document.getElementById("mensagemBusca");

    if (mostrar) {

        if (!mensagem) {

            mensagem = document.createElement("p");

            mensagem.id = "mensagemBusca";

            mensagem.textContent =
                "Nenhum produto encontrado.";

            document
                .querySelector(".produtos")
                .appendChild(mensagem);
        }

    } else {

        if (mensagem) {

            mensagem.remove();

        }

    }
}


// =========================
// PESQUISAR AO CLICAR NA LUPA
// =========================

if (botaoBusca) {

    botaoBusca.addEventListener("click", pesquisarProduto);

}


// =========================
// PESQUISAR AO APERTAR ENTER
// =========================

if (campoBusca) {

    campoBusca.addEventListener("keydown", function(event) {

        if (event.key === "Enter") {

            pesquisarProduto();

        }

    });


    // =========================
    // PESQUISAR ENQUANTO DIGITA
    // =========================

    campoBusca.addEventListener("input", function() {

        pesquisarProduto();

    });

}


// =========================
// CARRINHO
// =========================

function adicionarCarrinho(nomeProduto) {

    alert(nomeProduto + " foi adicionado ao carrinho!");

}