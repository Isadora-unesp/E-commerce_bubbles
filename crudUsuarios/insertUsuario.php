<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../util.php");

$destino = null;

try {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $telefone  = trim($_POST['telefone'] ?? '');
    $senhaPura = $_POST['senha'] ?? '';

    if ($nome === '' || $email === '' || $telefone === '' || $senhaPura === '') {
        header("Location: ../cadastro.php?erro=geral");
        exit;
    }

    $conn = conecta();
    $caminhoFoto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK && $_FILES['foto']['size'] > 0) {

        $arquivo = $_FILES['foto'];

        if ($arquivo['size'] > 2 * 1024 * 1024) {
            header("Location: ../cadastro.php?erro=foto");
            exit;
        }

        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo  = $finfo->file($arquivo['tmp_name']);

        if (!isset($tiposPermitidos[$tipo])) {
            header("Location: ../cadastro.php?erro=foto");
            exit;
        }

        $nomeArquivo  = bin2hex(random_bytes(16)) . '.' . $tiposPermitidos[$tipo];
        $pastaUploads = dirname(__DIR__) . '/uploads/';

        if (!is_dir($pastaUploads)) {
            @mkdir($pastaUploads, 0755, true);
        }

        if (!is_dir($pastaUploads) || !is_writable($pastaUploads)) {
            error_log('uploads/ nao existe ou sem permissao: ' . $pastaUploads);
            header("Location: ../cadastro.php?erro=geral");
            exit;
        }

        $destino = $pastaUploads . $nomeArquivo;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            $destino = null;
            header("Location: ../cadastro.php?erro=geral");
            exit;
        }

        $caminhoFoto = 'uploads/' . $nomeArquivo;

    } elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
        // arquivo grande demais pro php.ini ou upload interrompido
        header("Location: ../cadastro.php?erro=foto");
        exit;
    }

    $senha = password_hash($senhaPura, PASSWORD_DEFAULT);

    $insert = $conn->prepare(
        "INSERT INTO usuario
         (nome, email, senha, telefone, admin, excluido, imagem)
         VALUES
         (:nome, :email, :senha, :telefone, false, false, :foto)
         RETURNING id_usuario"
    );

    $insert->bindParam(':nome', $nome);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':senha', $senha);
    $insert->bindParam(':telefone', $telefone);
    $insert->bindParam(':foto', $caminhoFoto);

    $insert->execute();

    $_SESSION['usuario_id']  = $insert->fetchColumn();
    $_SESSION['logado']      = true;
    $_SESSION['foto_perfil'] = $caminhoFoto;

    header("Location: ../index.php");
    exit;

} catch (PDOException $e) {

    if ($destino && file_exists($destino)) {
        unlink($destino);
    }

    error_log($e->getMessage());

    if ($e->getCode() == "23505") {
        header("Location: ../cadastro.php?erro=email");
    } else {
        header("Location: ../cadastro.php?erro=geral");
    }
    exit;

} catch (Throwable $e) {

    if ($destino && file_exists($destino)) {
        unlink($destino);
    }

    error_log($e->getMessage());
    header("Location: ../cadastro.php?erro=geral");
    exit;
}