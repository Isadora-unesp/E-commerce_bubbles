<?php

session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

$varSQL = "SELECT id_produto, descricao
           FROM produto
           WHERE (excluido = false OR excluido IS NULL)
           ORDER BY descricao";

$select = $conn->query($varSQL);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adicionar Entrada</title>

    <link rel="stylesheet" href="styleCrudEntradas.css">

</head>

<body>

    <main class="container">

        <header class="pagina-header">

            <h1>Adicionar Entrada</h1>

            <p>
                Registre a entrada de um produto no estoque.
            </p>

        </header>


        <form
            class="formulario"
            action="insertEntradas.php"
            method="post"
        >

            <div class="campo">

                <label for="fk_produto">
                    Produto
                </label>

                <select
                    id="fk_produto"
                    name="fk_produto"
                    required
                >

                    <option value="">Selecione um produto</option>

                    <?php while ($produto = $select->fetch(PDO::FETCH_ASSOC)) { ?>

                        <option value="<?php echo $produto['id_produto']; ?>">
                            <?php echo htmlspecialchars($produto['descricao']); ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <div class="campo">

                <label for="quantidade">
                    Quantidade
                </label>

                <input
                    type="number"
                    id="quantidade"
                    name="quantidade"
                    min="1"
                    required
                >

            </div>


            <div class="campo">

                <label for="custo_unitario">
                    Custo Unitário
                </label>

                <input
                    type="number"
                    id="custo_unitario"
                    name="custo_unitario"
                    step="0.01"
                    min="0"
                    required
                >

            </div>


            <div class="campo">

                <label for="obs">
                    Observação
                </label>

                <input
                    type="text"
                    id="obs"
                    name="obs"
                >

            </div>


            <div class="acoes-formulario">

                <a
                    href="listarEntradas.php"
                    class="btn"
                >
                    Voltar
                </a>

                <button
                    type="submit"
                    class="btn-alterar"
                >
                    Salvar
                </button>

            </div>

        </form>

    </main>

</body>

</html>