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
 
function adicionarCarrinho(nomeProduto) {

    alert(nomeProduto + " foi adicionado ao carrinho!");

}