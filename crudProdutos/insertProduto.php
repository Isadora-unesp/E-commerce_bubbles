<?php
 
include("../util.php");

SaiSeHacker();

if (empty($_POST)) {
    header("Location: adicionarProduto.php");
    exit;
}

try {
    $conn = conecta();

    /* TESTE DE POR IMAGEM
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $nomeOriginal = $_FILES['imagem']['name'];
        $arquivoTemporario = $_FILES['imagem']['tmp_name'];

        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($extensao, $extensoesPermitidas)) {
            die("Formato de imagem não permitido.");
        }

        $novoNome = uniqid() . "." . $extensao;

        // Pasta física onde a imagem será salva
        $pasta = "../img/";

        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $caminhoArquivo = $pasta . $novoNome;

        if (!move_uploaded_file($arquivoTemporario, $caminhoArquivo)) {
            die("Erro ao salvar a imagem.");
        }

        // Caminho que será salvo no banco
        $caminhoBanco = "img/" . $novoNome;

    }*/

    $varSQL = "INSERT INTO produto 
               (nome, descricao, categoria, peso, fragrancia, valor_unitario, imagem, excluido) 
               VALUES 
               (:nome, :descricao, :categoria, :peso, :fragrancia, :valor_unitario, :imagem, false)";

    $insert = $conn->prepare($varSQL);

    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':descricao', $_POST['descricao']);
    $insert->bindParam(':categoria', $_POST['categoria']);
    $insert->bindParam(':peso', $_POST['peso']);
    $insert->bindParam(':fragrancia', $_POST['fragrancia']);
    $insert->bindParam(':valor_unitario', $_POST['valor_unitario']);
    $insert->bindValue(':imagem', trim($_POST['imagem'] ?? ''));
    
    $insert->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
