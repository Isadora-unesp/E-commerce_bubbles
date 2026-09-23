<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Cadastro </title>
   <link rel="stylesheet" href="styleCLP.css">
</head>
<body>


   <main class="container">


       <div class="cadastro">


           <h1>Cadastre-se na Fruit Bubbles</h1>
           <p class="subtitulo">
               Crie sua conta e descubra nossos produtos!
           </p>


           <?php if (isset($_GET['erro']) && $_GET['erro'] === 'email') { ?>

               <p class="erro">
                   Este email já está cadastrado.
               </p>

           <?php } elseif (isset($_GET['erro'])) { ?>

               <p class="erro">
                   Não foi possível concluir o cadastro. Tente novamente.
               </p>

           <?php } ?>


           <form action="insertUsuario.php" method="post">
               <div class="campo">
                   <label for="nome">Nome completo</label>




                   <input type="text" name="nome" maxlength="80"
                   placeholder="Digite seu nome" required>
               </div>


               <div class="campo">
                   <label for="email">Email</label>


                   <input type="email" name="email"
                   placeholder="Digite seu email" required>
               </div>




               <div class="campo">
                   <label for="senha">Senha</label>




                   <input type="password" name="senha"
                   placeholder="Crie uma senha" required>
               </div>


               <div class="campo">
                   <label for="telefone">Telefone</label>




                   <input type="tel" name="telefone"
                   placeholder="(00) 00000-0000" required>
               </div>


               <button type="submit">CADASTRAR-SE</button>




           </form>

           <p class="login">
               Já possui uma conta?
               <a href="login.php">Entrar</a>
           </p>

       </div>

   </main>

</body>

</html>