<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar cadastro | Fruit Bubbles</title>
    <link rel="stylesheet" href="styleCLP.css">
</head>

<body class="pagina-cadastro-fb">

<a href="index.php" class="voltar-index">
    <span>←</span> Voltar
</a>

<main class="container">
    <section class="cadastro">

        <h1>Criar cadastro</h1>
        <p class="subtitulo">
            Crie sua conta para continuar.
        </p>

        <?php
        $erros = [
            'email' => 'Este e-mail já está cadastrado.',
            'foto' => 'A foto deve ser JPG, PNG ou WebP e ter até 2 MB.',
            'geral' => 'Não foi possível concluir o cadastro. Tente novamente.'
        ];

        $erro = $_GET['erro'] ?? '';

        if (isset($erros[$erro])):
        ?>
            <p class="erro-cadastro" role="alert">
                <?= htmlspecialchars($erros[$erro], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form
            action="crudUsuarios/insertUsuario.php"
            method="post"
            enctype="multipart/form-data"
        >

            <div class="foto-perfil-container cadastro-foto-area">

                <div class="foto-perfil-label">
                    <img
                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' 
                            fill='none' stroke='%23b08968' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='8' r='4'/%3E%3Cpath d='M4 21c0-4 3.5-7 8-7s8 3 8 7'/%3E%3C/svg%3E"
                        alt="Prévia da foto de perfil"
                        id="preview-foto"
                        class="foto-perfil"
                    >
                </div>

                <div class="acoes-foto-cadastro">

                    <label for="foto" class="botao-foto">
                        ▣ Escolher foto
                    </label>

                    <button
                        type="button"
                        class="botao-foto"
                        id="botaoTirarFoto"
                    >
                        ▣ Tirar foto
                    </button>

                </div>

                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept="image/jpeg,image/png,image/webp"
                    class="input-foto"
                >

                <input
                    type="file"
                    id="fotoCamera"
                    accept="image/jpeg,image/png,image/webp"
                    capture="user"
                    class="input-foto"
                >

            </div>

            <div class="campo">
                <label for="nome">Nome completo</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    maxlength="80"
                    placeholder="Digite seu nome"
                    required
                    autocomplete="name"
                >
            </div>

            <div class="campo">
                <label for="telefone">Telefone</label>
                <input
                    type="tel"
                    id="telefone"
                    name="telefone"
                    maxlength="20"
                    placeholder="(14) 99999-9999"
                    required
                    autocomplete="tel"
                >
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="100"
                    placeholder="Digite seu e-mail"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="campo">

                <label for="senha">Senha</label>

                <div class="campo-senha">
                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Crie uma senha"
                        required
                        autocomplete="new-password"
                    >

                    <button
                        type="button"
                        id="mostrarSenha"
                        class="botao-olho"
                        aria-label="Mostrar senha"
                        aria-pressed="false"
                    >
                        ◉
                    </button>
                </div>

            </div>

            <button type="submit" class="botao-criar-conta">
                Criar conta
            </button>

        </form>

        <p class="login">
            Já possui uma conta?
            <a href="login.php">Entrar</a>
        </p>

    </section>
</main>

<script>
const foto = document.getElementById('foto');
const camera = document.getElementById('fotoCamera');
const previa = document.getElementById('preview-foto');

let urlAnterior = null;

function validarFoto(arquivo) {
    if (!arquivo) return false;

    if (
        !['image/jpeg', 'image/png', 'image/webp'].includes(arquivo.type) ||
        arquivo.size > 2 * 1024 * 1024
    ) {
        alert('Escolha uma foto JPG, PNG ou WebP de até 2 MB.');
        return false;
    }

    if (urlAnterior) {
        URL.revokeObjectURL(urlAnterior);
    }

    urlAnterior = URL.createObjectURL(arquivo);
    previa.src = urlAnterior;

    return true;
}

foto.addEventListener('change', () => {
    if (!validarFoto(foto.files[0])) {
        foto.value = '';
    }
});

document.getElementById('botaoTirarFoto')
    .addEventListener('click', () => camera.click());

camera.addEventListener('change', () => {
    if (!validarFoto(camera.files[0])) {
        camera.value = '';
        return;
    }

    const transferencia = new DataTransfer();
    transferencia.items.add(camera.files[0]);
    foto.files = transferencia.files;
});

document.getElementById('mostrarSenha')
    .addEventListener('click', function () {

        const campo = document.getElementById('senha');
        const visivel = campo.type === 'password';

        campo.type = visivel ? 'text' : 'password';

        this.setAttribute('aria-pressed', String(visivel));
        this.setAttribute(
            'aria-label',
            visivel ? 'Ocultar senha' : 'Mostrar senha'
        );
    });
</script>

</body>
</html>
