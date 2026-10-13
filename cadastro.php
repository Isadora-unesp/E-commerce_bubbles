
<form action="crudUsuarios/insertUsuario.php"
      method="post"
      enctype="multipart/form-data">

    <div class="campo">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome"
               maxlength="80"
               placeholder="Digite seu nome" required>
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               placeholder="Digite seu email" required>
    </div>

    <div class="campo">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha"
               placeholder="Crie uma senha" required>
    </div>

    <div class="campo">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone"
               placeholder="(00) 00000-0000" required>
    </div>

    <div class="foto-perfil-container">
        <label for="foto" class="foto-perfil-label">
            <img
                src="https://placehold.co/120x120/fff2e8/46220f?text=Foto"
                alt="Prévia da foto de perfil"
                id="preview-foto"
                class="foto-perfil"
            >
            <span class="foto-editar">+</span>
        </label>

        <input
            type="file"
            id="foto"
            name="foto"
            accept="image/jpeg,image/png,image/webp"
            class="input-foto"
        >

        <p>Adicione sua foto de perfil</p>
    </div>

    <button type="submit">Cadastrar</button>

</form>
           <p class="login">
               Já possui uma conta?
               <a href="login.php">Entrar</a>
           </p>

       </div>

<script>
const campoFoto = document.getElementById('foto');
const previewFoto = document.getElementById('preview-foto');

campoFoto.addEventListener('change', function () {
    const arquivo = this.files[0];

    if (!arquivo) return;

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

   </main>

</body>

</html>