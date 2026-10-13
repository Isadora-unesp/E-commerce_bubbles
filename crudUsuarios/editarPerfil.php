<?php
include("../util.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$conn = conecta();
$id = $_SESSION['usuario_id'];

$varSQL = "SELECT *
           FROM usuario
           WHERE id_usuario = :id
           AND (excluido = false OR excluido IS NULL)";

$select = $conn->prepare($varSQL);
$select->bindParam(':id', $id);
$select->execute();

$linha = $select->fetch(PDO::FETCH_ASSOC);

if (!$linha) {
    echo "Usuário não encontrado.";
    exit;
}

$nome = $linha['nome'];
$email = $linha['email'];
$telefone = $linha['telefone'];
$fotoPerfil = $linha['foto_perfil'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | Fruit Bubbles</title>
    <link rel="stylesheet" href="../styleCLP.css">
</head>

<body>

    <main class="container">
        <section class="perfil">

            <h1>Editar Perfil</h1>

            <p class="mensagem">
                Atualize suas informações pessoais
            </p>

            <form class="informacoes"
                  action="updateUsuario.php"
                  method="post"
                  enctype="multipart/form-data">

                <div class="foto-perfil-container">
                    <label for="foto" class="foto-perfil-label">

                        <img
                            id="preview-foto"
                            class="foto-perfil"
                            src="<?php
                                echo !empty($fotoPerfil)
                                    ? '../' . htmlspecialchars($fotoPerfil, ENT_QUOTES, 'UTF-8')
                                    : 'https://placehold.co/120x120/fff2e8/46220f?text=FB';
                            ?>"
                            alt="Foto de perfil"
                        >

                        <span class="foto-editar">+</span>
                    </label>

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        class="input-foto"
                        accept="image/*"
                    >

                    <p>Toque na foto para escolher outra (máximo 2 MB).</p>
                </div>

                <div class="campo">
                    <label class="titulo" for="nome">Nome</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="80"
                        value="<?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>"
                        required
                    >
                </div>

                <div class="campo">
                    <label class="titulo" for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        maxlength="100"
                        value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                        required
                    >
                </div>

                <div class="campo">
                    <label class="titulo" for="telefone">Telefone</label>
                    <input
                        type="text"
                        id="telefone"
                        name="telefone"
                        maxlength="20"
                        value="<?php echo htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

                <div class="campo">
                    <label class="titulo" for="senha">Nova senha</label>
                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Deixe vazio para manter a senha atual"
                        autocomplete="new-password"
                    >
                </div>

                <div class="botoes">
                    <input class="editar" type="submit" value="Salvar">
                    <a class="sair" href="../perfilUsuario.php">Cancelar</a>
                </div>

            </form>

            <div class="botoes">
                <a class="excluir confirmar-exclusao"
                   href="excluirUsuario.php">
                    Excluir Conta
                </a>
            </div>

        </section>
    </main>

    <script>
        const campoFoto = document.getElementById('foto');
        const previewFoto = document.getElementById('preview-foto');

        campoFoto.addEventListener('change', function () {
            const arquivo = this.files[0];

            if (!arquivo) {
                return;
            }

            if (!arquivo.type.startsWith('image/')) {
                alert('Selecione um arquivo de imagem válido.');
                this.value = '';
                return;
            }

            if (arquivo.size > 2 * 1024 * 1024) {
                alert('A imagem deve ter no máximo 2 MB.');
                this.value = '';
                return;
            }

            previewFoto.src = URL.createObjectURL(arquivo);
        });
    </script>

    <script src="../script.js"></script>

</body>
</html>