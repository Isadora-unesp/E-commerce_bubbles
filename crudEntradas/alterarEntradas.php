<?php
 
include("../util.php");

SaiSeHacker();

if (!isset($_GET['id'])) {
    header("Location: listarEntradas.php");
    exit;
}

$conn = conecta();

$id = $_GET['id'];

$varSQL = "SELECT *
           FROM entrada
           WHERE id_entrada = :id";

$select = $conn->prepare($varSQL);
$select->bindParam(':id', $id);
$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

if (!$linha) {
    echo "Entrada não encontrada.";
    exit;
}

$id = $linha['id_entrada'];
$quantidade = $linha['quantidade'];
$custo_unitario = $linha['custo_unitario'];
$obs = $linha['obs'];
$fk_produto = $linha['fk_produto'];

$varSQLProdutos = "SELECT id_produto, descricao
                   FROM produto
                   WHERE (excluido = false OR excluido IS NULL)
                   ORDER BY descricao";

$selectProdutos = $conn->query($varSQLProdutos);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alterar Entrada</title>

    <link rel="stylesheet" href="styleCrudEntradas.css">

</head>

<body>

    <main class="container">

        <header class="pagina-header">

            <h1>Alterar Entrada</h1>

            <p>
                Atualize os dados da entrada abaixo.
            </p>

        </header>


        <form
            class="formulario"
            action="updateEntradas.php"
            method="post"
        >

            <input
                type="hidden"
                name="id"
                value="<?php echo htmlspecialchars($id); ?>"
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

                    <?php while ($produto = $selectProdutos->fetch(PDO::FETCH_ASSOC)) { ?>

                        <option
                            value="<?php echo $produto['id_produto']; ?>"
                            <?php if ($produto['id_produto'] == $fk_produto) echo "selected"; ?>
                        >
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
                    value="<?php echo htmlspecialchars($quantidade); ?>"
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
                    value="<?php echo htmlspecialchars($custo_unitario); ?>"
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
                    value="<?php echo htmlspecialchars($obs ?? ''); ?>"
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
                    Alterar
                </button>

            </div>

        </form>

    </main>

</body>

</html>