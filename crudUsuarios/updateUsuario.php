<?php

include("../util.php");

if (!isset($_SESSION['usuario_id']) &&
    !(isset($_SESSION['admin']) && $_SESSION['admin'] === true)) {
    header("Location: ../login.php");
    exit;
}

try {
    $conn = conecta();

    // Define qual usuário será atualizado
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        if (!isset($_POST['id'])) {
            header("Location: listarUsuario.php");
            exit;
        }

        $id = $_POST['id'];
    } else {
        $id = $_SESSION['usuario_id'];
    }

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $senhaNova = $_POST['senha'] ?? '';

    if ($nome === '' || $email === '') {
        exit("Preencha o nome e o email.");
    }

    // Busca a foto atual para mantê-la se nenhuma nova for enviada
    $consulta = $conn->prepare(
        "SELECT imagem FROM usuario WHERE id_usuario = :id"
    );
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    $usuarioAtual = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioAtual) {
        exit("Usuário não encontrado.");
    }

    $fotoPerfil = $usuarioAtual['imagem'] ?? null;

    // Verifica se uma nova foto foi enviada
    if (isset($_FILES['foto']) &&
        $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {

        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            exit("Não foi possível enviar a foto. Tente novamente.");
        }

        if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
            exit("A foto deve ter no máximo 2 MB.");
        }

        // Confere o tipo real do arquivo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo = $finfo->file($_FILES['foto']['tmp_name']);

        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($tiposPermitidos[$tipo])) {
            exit("Envie uma imagem JPG, PNG ou WEBP.");
        }

        // Cria a pasta se ela ainda não existir
        $pastaUploads = dirname(__DIR__) . '/uploads/';

        if (!is_dir($pastaUploads) &&
            !mkdir($pastaUploads, 0755, true)) {
            exit("Não foi possível criar a pasta de imagens.");
        }

        // Gera um nome único para a imagem
        $nomeArquivo = bin2hex(random_bytes(16))
                     . '.' . $tiposPermitidos[$tipo];

        $destino = $pastaUploads . $nomeArquivo;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            exit("Não foi possível salvar a foto.");
        }

        // Caminho que será guardado no banco
        $fotoPerfil = 'uploads/' . $nomeArquivo;
    }

    // Monta a atualização dos dados
    $campos = "nome = :nome,
               email = :email,
               telefone = :telefone,
               imagem = :foto_perfil";

    if ($senhaNova !== '') {
        $senha = password_hash($senhaNova, PASSWORD_DEFAULT);
        $campos .= ", senha = :senha";
    }

    $varSQL = "UPDATE usuario
               SET $campos
               WHERE id_usuario = :id";

    $update = $conn->prepare($varSQL);

    $update->bindParam(':nome', $nome);
    $update->bindParam(':email', $email);
    $update->bindParam(':telefone', $telefone);
    $update->bindParam(':foto_perfil', $fotoPerfil);
    $update->bindParam(':id', $id);

    if ($senhaNova !== '') {
        $update->bindParam(':senha', $senha);
    }

    $update->execute();

    // Atualiza a sessão do usuário comum
    if (!(isset($_SESSION['admin']) && $_SESSION['admin'] === true)) {
        $_SESSION['foto_perfil'] = $fotoPerfil;
    }

    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        header("Location: listarUsuario.php");
        exit;
    }

    header("Location: ../perfilUsuario.php");
    exit;

} catch (PDOException $e) {
    if ($e->getCode() == "23505") {
        echo "Erro: este email já está cadastrado.";
    } else {
        error_log($e->getMessage());
        echo "Ocorreu um erro ao atualizar o perfil.";
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    echo "Ocorreu um erro ao atualizar o perfil.";
}
?>