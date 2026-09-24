<?php

// Exibe todos os erros do PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia ou retoma a sessão HTTP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define estoque mínimo padrão na sessão, se ainda não existir
if (!isset($_SESSION['estoqueMinimo'])) {
    $_SESSION['estoqueMinimo'] = 5;
}

// Conecta ao banco de dados
function conecta($paramStringConexao = "")
{
    if ($paramStringConexao == "") {
        $paramStringConexao = "pgsql:host=projetoscti.com.br;port=54432;dbname=loja3a;user=loja3a;password=oiidq0S5VlVOKmu";
    }


    try {
        $c = new PDO($paramStringConexao);
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Nao conectado<br>";
        echo $e->getMessage();
        exit;
    }


    return $c;
}



// Retorna o caminho físico da raiz do projeto
function Raiz()
{
    // Para a versão publicada:
    if (isset($_SESSION['raiz'])) {
        return str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . $_SESSION['raiz'];
    }
    // Para o ambiente de desenvolvimento local:
    return str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
}

//FUNÇÕES COMENTADAS ATÉ BAIXAR A BIBLIOTECA PHPMAILER
/*
// Verifica se o arquivo de imagem existe no sistema de arquivos.
function ImagemJaExiste($paramImagem)
{
    $caminhoFisico = Raiz() . "/" . $paramImagem;
    return file_exists($caminhoFisico);
}

// Cria ou atualiza um cookie com tempo de expiração em minutos.
function DefineCookie($paramNome, $paramValor, $paramMin)
{
    setcookie($paramNome, $paramValor, time() + ($paramMin * 60));
}

// Remove um cookie existente.
function MatarCookie($paramNome)
{
    setcookie($paramNome, "", time() - 3600);
}

// Executa instruções SQL do tipo INSERT, UPDATE ou DELETE.
function ExecutaSQL($paramConn, $paramSQL)
{
    $linhas = $paramConn->exec($paramSQL);
    return ($linhas > 0);
}

// Executa uma consulta SELECT simples e retorna o valor do primeiro campo retornado.
function ValorSQL($paramConn, $paramSQL)
{
    $stmt = $paramConn->query($paramSQL);
    if ($stmt) {
        $linha = $stmt->fetch(PDO::FETCH_NUM);
        if ($linha) {
            return $linha[0];
        }
    }
    return null;
}

// Valida as credenciais do usuário no banco de dados.
function ValidaLogin($paramLogin, $paramSenha, &$nome, &$foto, &$eh_admin)
{
    global $conn; // Utiliza a conexão PDO global
    
    $sql = "SELECT id_usuario, nome, senha, foto, admin FROM usuario WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $paramLogin);
    $stmt->execute();
    
    if ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Verifica a senha criptografada usando password_verify
        if (password_verify($paramSenha, $usuario['senha'])) {
            $nome = $usuario['nome'];
            $foto = $usuario['foto'];
            $eh_admin = $usuario['admin'];
            return true;
        }
    }
    return false;
}

// Realiza o login automático do usuário após o cadastro.
function LogaAutomatico($paramLogin, $paramSenha)
{
    $nome = "";
    $foto = "";
    $eh_admin = false;

    if (ValidaLogin($paramLogin, $paramSenha, $nome, $foto, $eh_admin)) {
        $_SESSION['sessaoConectado'] = true;
        $_SESSION['sessaoAdmin'] = $eh_admin;
        $_SESSION['sessaoLogin'] = $paramLogin;
        $_SESSION['sessaoNome'] = $nome;
        $_SESSION['sessaoFoto'] = $foto;

        DefineCookie('loginCookie', $paramLogin, 60);

        header('Location: /index.php');
        exit;
    }
}

// Trata e salva imagens enviadas via formulário gerando nomes únicos.
function SalvaUpload2($paramFiles, $paramCampo)
{
    if (isset($paramFiles[$paramCampo]) && $paramFiles[$paramCampo]['size'] > 0) {
        // Obtém a extensão do arquivo enviado
        $ext = pathinfo($paramFiles[$paramCampo]['name'], PATHINFO_EXTENSION);
        
        // Gera um nome exclusivo baseado nos milissegundos do sistema
        $novoNome = uniqid('', true) . '.' . $ext;
        
        // Caminho relativo salvo na base de dados e caminho de destino no servidor
        $caminhoRelativo = "imagens/" . $novoNome;
        $destino = Raiz() . "/" . $caminhoRelativo;

        // Move o arquivo temporário para a pasta destino
        if (move_uploaded_file($paramFiles[$paramCampo]['tmp_name'], $destino)) {
            return $caminhoRelativo;
        }
    }
    return "";
}

// Dispara e-mails em HTML utilizando a biblioteca PHPMailer via SMTP.
function EnviaEmail($pEmailDestino, $pAssunto, $pHtml, 
                    $pUsuario = "marcelocabello@projetoscti.com.br", 
                    $pSenha = "MarceloC@belo", 
                    $pSMTP = "smtp.projetoscti.com.br")
{
    // Certifique-se de que o PHPMailer está na raiz do projeto
    require_once Raiz() . '/PHPMailer/PHPMailerAutoload.php';

    echo "<br>Tentando enviar para $pEmailDestino...";
    
    $mail = new PHPMailer();
    $mail->IsSMTP(); // Configura o servidor como SMTP
    $mail->Host = $pSMTP;
    $mail->SMTPAuth = true; // Requer autenticação
    $mail->SMTPSecure = 'tls'; // Nível de segurança TLS
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Port = 587; // Porta do serviço SMTP
    $mail->Username = $pUsuario;
    $mail->Password = $pSenha;
    $mail->From = $pUsuario;
    $mail->FromName = "Suporte de senhas";
    $mail->AddAddress($pEmailDestino, "Usuario");
    $mail->IsHTML(true); // Define o formato em HTML
    $mail->Subject = $pAssunto;
    $mail->Body = $pHtml;

    $enviado = $mail->Send(); // Envia a mensagem

    if (!$enviado) {
        echo "<br>Erro: " . $mail->ErrorInfo;
    } else {
        echo "<br><b>Enviado!</b>";
    }

    return $enviado;
}
*/

function SaiSeHacker() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: ../index.php");
        exit;
    }
}

?>

