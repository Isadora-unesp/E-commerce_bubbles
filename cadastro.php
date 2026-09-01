<!DOCTYPE html>
<html lang="pt-br">


<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">


   <title> Cadastro </title>


   <link rel="stylesheet" href="style.css">
</head>


<body>


   <main class="container">


       <div class="cadastro">


           <h1>Cadastre-se na Fruit Bubbles</h1>


           <p class="subtitulo">
               Crie sua conta e descubra nossos produtos!
           </p>


           <form>


               <div class="campo">
                   <label for="nome">Nome completo</label>


                   <input type="text" id="nome"
                   placeholder="Digite seu nome" required>
               </div>


               <div class="campo">
                   <label for="email">Email</label>


                   <input type="email" id="email"
                   placeholder="Digite seu email" required>
               </div>


               <div class="campo">
                   <label for="senha">Senha</label>


                   <input type="password" id="senha"
                   placeholder="Crie uma senha" required>
               </div>


               <div class="campo">
                   <label for="cpf">CPF</label>


                   <input type="text" id="cpf"
                   placeholder="000.000.000-00" required>
               </div>


               <div class="campo">
                   <label for="telefone">Telefone</label>


                   <input type="tel" id="telefone"
                   placeholder="(00) 00000-0000" required>
               </div>


               <button type="submit">
                   CADASTRAR-SE
               </button>


           </form>


           <p class="login">
               Já possui uma conta?
               <a href="#">Entrar</a>
           </p>


       </div>


   </main>


</body>


</html>
