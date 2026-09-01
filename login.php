<!DOCTYPE html>
<html lang="pt-br">


<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">


   <title>Login</title>


   <link rel="stylesheet" href="style.css">
</head>


<body>


   <main class="container">


       <section class="cadastro">


           <h1>Login</h1>

           <br>
           <p class="mensagem">
               Entre na sua conta para continuar
           </p>
           <br>

           <form>


               <div class="campo">
                   <label for="email">Email</label>


                   <input
                       type="email"
                       id="email"
                       placeholder="Digite seu email"
                       required
                   >
               </div>


               <div class="campo">
                   <label for="senha">Senha</label>


                   <input
                       type="password"
                       id="senha"
                       placeholder="Digite sua senha"
                       required
                   >
               </div>


               <a href="#" class="esqueceu-senha">
                   Esqueceu sua senha?
               </a>


               <button type="submit">
                   ENTRAR
               </button>


           </form>

           <br>
           <p>
               Ainda não possui uma conta?
               <a href="cadastro.html">Cadastre-se</a>
           </p>


       </section>


   </main>


</body>


</html>
