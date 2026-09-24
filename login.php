<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Login</title>

   <link rel="stylesheet" href="styleCLP.css">
</head>

<body>

   <a href="index.php" class="voltar-index" aria-label="Voltar para a página inicial">
       <span>←</span> Voltar
   </a>

   <main class="container">

       <section class="cadastro">

           <h1>Login</h1>
           <br>
           <p class="mensagem">
               Entre na sua conta para continuar
           </p>
           <br>

           <?php if (isset($_GET['erro'])) { ?>

               <p class="erro">
                   Email ou senha incorretos.
               </p>

           <?php } ?>

           <form method="post" action="loginUsuario.php">

               <div class="campo">
                   <label for="email">Email</label>

                   <input
                       type="email"
                       name="email"
                       placeholder="Digite seu email"
                       required
                   >
               </div>

               <div class="campo">
                   <label for="senha">Senha</label>

                   <input
                       type="password"
                       name="senha"
                       placeholder="Digite sua senha"
                       required
                   >
               </div>

               <a href="#" class="esqueceu-senha">
                   Esqueceu sua senha?
               </a>

               <button type="submit">Entrar</button>

           </form>


           <br>
           <p>
                Ainda não possui uma conta?
                <a href="cadastro.php">Cadastre-se</a>
           </p>

       </section>

   </main>

</body>

</html>