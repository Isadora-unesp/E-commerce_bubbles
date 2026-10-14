
<?php
function salvarImagemProduto($arquivo) {
    if (!isset($arquivo) || $arquivo['error'] === UPLOAD_ERR_NO_FILE) return null;

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Falha no envio da imagem.');
    }

    if ($arquivo['size'] > 5 * 1024 * 1024) {
        throw new RuntimeException('A imagem deve ter no máximo 5 MB.');
    }

    $tipos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif'
    ];

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($arquivo['tmp_name']);

    if (!isset($tipos[$mime]) || @getimagesize($arquivo['tmp_name']) === false) {
        throw new RuntimeException('Arquivo de imagem inválido.');
    }

    $pasta = __DIR__ . '/../img/produtos/';

    if (!is_dir($pasta) && !mkdir($pasta, 0755, true)) {
        throw new RuntimeException('Não foi possível criar a pasta de imagens.');
    }

    $nome = bin2hex(random_bytes(16)) . '.' . $tipos[$mime];

    if (!move_uploaded_file($arquivo['tmp_name'], $pasta . $nome)) {
        throw new RuntimeException('Não foi possível salvar a imagem.');
    }

    return 'img/produtos/' . $nome;
}
