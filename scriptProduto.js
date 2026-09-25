//                    BUSCA DE PRODUTO

const campoBusca = document.getElementById("campoPesquisa");
const botaoBusca = document.getElementById("botaoBusca");
const suggestionsBox = document.getElementById("suggestions-dropdown");

let currentFocus = -1;

// Normalizar Texto -----------------------
function normalizarTexto(texto) {
    return texto
        .toLowerCase()
        .trim()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}


// PESQUISAR PRODUTOS

function pesquisarProdutos() {

    if (!campoBusca) return;

    const pesquisa = normalizarTexto(campoBusca.value.trim());

    const produtos = document.querySelectorAll(".produto");

    let encontrou = false;

    produtos.forEach(produto => {

        const nomeProduto =
            produto.getAttribute("data-nome") || "";

        const titulo =
            (produto.querySelector("h3")?.textContent || "")
            .replace(/\s+/g, " ")
            .trim();

        const descricao =
            produto.querySelector(".descricao")?.textContent || "";

        const textoProduto = normalizarTexto(
            nomeProduto + " " + titulo + " " + descricao
        );

        if (
            pesquisa === "" ||
            textoProduto.includes(pesquisa)
        ) {
            produto.style.display = "";
            encontrou = true;
        } else {
            produto.style.display = "none";
        }

    });

    mostrarMensagemBusca(!encontrou && pesquisa !== "");
}


//NENHUM RESULTADO

function mostrarMensagemBusca(mostrar) {

    const mensagem = document.getElementById("no_results");

    if (!mensagem) return;

    mensagem.style.display = mostrar ? "block" : "none";
}


//Sugestões

function mostrarSugestoes() {

    if (!campoBusca || !suggestionsBox) return;

    const valor = normalizarTexto(campoBusca.value);

    suggestionsBox.innerHTML = "";
    currentFocus = -1;

    if (valor === "") {
        suggestionsBox.style.display = "none";

        document.querySelectorAll(".produto").forEach(produto => {
            produto.style.display = "";
        });

        mostrarMensagemBusca(false);

        return;
    }

    const produtos = document.querySelectorAll(".produto");

    let encontrou = false;

    produtos.forEach(produto => {

        const titulo =
            produto.querySelector("h3")?.textContent || "";

        const descricao =
            produto.querySelector(".descricao")?.textContent || "";

        const nome =
            produto.getAttribute("data-nome") || "";

        const texto = normalizarTexto(
            nome + " " + titulo + " " + descricao
        );

        if (texto.includes(valor)) {

    console.log("Sugestão criada:", titulo); // debug


            encontrou = true;

            produto.style.display = "";

            const sugestao =
                document.createElement("div");

            sugestao.classList.add("suggestion-item");

            sugestao.textContent = titulo;

            sugestao.addEventListener("click", function () {

                const pagina = produto.getAttribute("data-pagina");

                if (pagina) {
                    window.location.href = pagina;
                }

            });

                        suggestionsBox.appendChild(sugestao);

                    } else {

                        produto.style.display = "none";

                    }

                });


//RESUTADOS

    if (encontrou) {

        suggestionsBox.style.display = "block";
        mostrarMensagemBusca(false);

    } else {

        const semResultado =
            document.createElement("div");

        semResultado.classList.add("no-suggestion-item");

        semResultado.textContent =
            "Nenhum produto encontrado.";

        suggestionsBox.appendChild(semResultado);

        suggestionsBox.style.display = "block";

        mostrarMensagemBusca(true);
    }
}


//BOTÃO DE BUSCA

if (botaoBusca) {

    botaoBusca.addEventListener("click", function () {
        mostrarSugestoes();
    });

}

// DIGITAÇÃO

if (campoBusca) {

    campoBusca.addEventListener("input", function () {
        mostrarSugestoes();
    });


    campoBusca.addEventListener("keydown", function(event) {

        if (!suggestionsBox) return;

        const sugestoes =
            suggestionsBox.querySelectorAll(".suggestion-item");


        // SETA PARA BAIXO

        if (event.key === "ArrowDown") {

            event.preventDefault();

            if (sugestoes.length === 0) {
                return;
            }

            currentFocus++;

            if (currentFocus >= sugestoes.length) {
                currentFocus = 0;
            }

            atualizarSugestaoAtiva(sugestoes);
        }


        // SETA PARA CIMA

        else if (event.key === "ArrowUp") {

            event.preventDefault();

            if (sugestoes.length === 0) {
                return;
            }

            currentFocus--;

            if (currentFocus < 0) {
                currentFocus = sugestoes.length - 1;
            }

            atualizarSugestaoAtiva(sugestoes);
        }


        // ENTER

        else if (event.key === "Enter") {

            event.preventDefault();

            // Se uma sugestão estiver selecionada
            if (
                currentFocus >= 0 &&
                currentFocus < sugestoes.length
            ) {

                sugestoes[currentFocus].click();

                return;
            }

            // Se não selecionou uma sugestão,
            // procurar pelo nome digitado

            const pesquisa = normalizarTexto(campoBusca.value);

            const produtos = document.querySelectorAll(".produto");

            for (const produto of produtos) {

                const titulo =
                    (produto.querySelector("h3")?.textContent || "")
                    .replace(/\s+/g, " ")
                    .trim();

                const nome =
                    produto.getAttribute("data-nome") || "";

                const pagina =
                    produto.getAttribute("data-pagina");

                const tituloNormalizado =
                    normalizarTexto(titulo);

                const nomeNormalizado =
                    normalizarTexto(nome);


                if (
                    pesquisa === tituloNormalizado ||
                    pesquisa === nomeNormalizado
                ) {

                    if (pagina) {
                        window.location.href = pagina;
                    }

                    return;
                }
            }

            // Caso não encontre exatamente
            pesquisarProdutos();

            suggestionsBox.style.display = "none";
        }


        // ESC

        else if (event.key === "Escape") {

            suggestionsBox.style.display = "none";

            currentFocus = -1;
        }

    });

}

//DESTACAR SUGESTAO ATIVA

function atualizarSugestaoAtiva(sugestoes) {

    sugestoes.forEach(function(sugestao) {
        sugestao.classList.remove("suggestion-item-active");
    });

    if (currentFocus >= 0 && currentFocus < sugestoes.length) {

        sugestoes[currentFocus].classList.add(
            "suggestion-item-active"
        );

        sugestoes[currentFocus].scrollIntoView({
            block: "nearest"
        });
    }
}


//FECHAR SUGETAO DE FORA

document.addEventListener("click", function(event) {

    if (!campoBusca || !suggestionsBox) return;

    if (
        !campoBusca.contains(event.target) &&
        !suggestionsBox.contains(event.target)
    ) {

        suggestionsBox.style.display = "none";

        currentFocus = -1;
    }

});


// MOSTRAR DE NOVO AO FOCAR

if (campoBusca) {

    campoBusca.addEventListener("focus", function() {

        if (
            this.value.trim() !== "" &&
            suggestionsBox &&
            suggestionsBox.children.length > 0
        ) {

            suggestionsBox.style.display = "block";
        }

    });

}