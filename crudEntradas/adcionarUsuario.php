<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Cadastrar Usuário</h2>

    <form action="insertUsuario.php" method="post">

        <label>Nome completo</label>
        <input type="text" name="nome" maxlength="80" required>

        <label>Email</label>
        <input type="email" name="email" maxlength="100" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <label>Telefone</label>
        <input type="text" name="telefone" maxlength="20">

        <input type="submit" value="Cadastrar">

    </form>

    <div class="menu">
        <a href="index.php">Voltar</a>
    </div>

</div>

</body>

</html>