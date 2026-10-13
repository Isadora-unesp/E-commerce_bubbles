
<?php


include("../util.php");

try {

    $conn = conecta();

    // Verifica se uma foto foi enviada
    $caminhoFoto = null;

    if (
        isset($_FILES['foto']) &&
        $_FILES['foto']['error'] === UPLOAD_ERR_OK &&
        $_FILES['foto']['size'] > 0
    ) {

        $arquivo = $_FILES['foto'];

        // Limite de 2 MB
        if ($arquivo['size'] > 2 * 1024 * 1024) {
            header("Location: ../cadastro.php?erro=foto");
            exit;
        }

        // Confere o tipo real do arquivo
        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo = $finfo->file($arquivo['tmp_name']);

        if (!isset($tiposPermitidos[$tipo])) {
            header("Location: ../cadastro.php?erro=foto");
            exit;
        }

        // Cria um nome aleatório para evitar conflitos
        $nomeArquivo = bin2hex(random_bytes(16))
                     . '.'
                     . $tiposPermitidos[$tipo];

        // A pasta uploads fica na raiz do projeto
        $pastaUploads = dirname(__DIR__) . '/uploads/';

        if (!is_dir($pastaUploads) ||
            !is_writable($pastaUploads)) {
            header("Location: ../cadastro.php?erro=geral");
            exit;
        }

        $destino = $pastaUploads . $nomeArquivo;

        if (!move_uploaded_file(
            $arquivo['tmp_name'],
            $destino
        )) {
            header("Location: ../cadastro.php?erro=geral");
            exit;
        }

        // Caminho que será guardado no banco
        $caminhoFoto = 'uploads/' . $nomeArquivo;
    }

    $senha = password_hash(
        $_POST['senha'],
        PASSWORD_DEFAULT
    );

    $varSQL = "INSERT INTO usuario
               (nome, email, senha, telefone, admin, excluido, foto_perfil)
               VALUES
               (:nome, :email, :senha, :telefone, false, false, :foto)
               RETURNING id_usuario";

    $insert = $conn->prepare($varSQL);

    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':email', $_POST['email']);
    $insert->bindParam(':senha', $senha);
    $insert->bindParam(':telefone', $_POST['telefone']);
    $insert->bindParam(':foto', $caminhoFoto);

    $insert->execute();

    $id_usuario = $insert->fetchColumn();

    $_SESSION['usuario_id'] = $id_usuario;
    $_SESSION['logado'] = true;

    header("Location: ../index.php");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() == "23505") {
        header("Location: ../cadastro.php?erro=email");
        exit;
    } else {
        header("Location: ../cadastro.php?erro=geral");
        exit;
    }

} catch (Throwable $e) {

    header("Location: ../cadastro.php?erro=geral");
    exit;
}
?>