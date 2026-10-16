<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/phpmailer/phpmailer/src/SMTP.php';

// Configurações da recuperação de senha
const RECUPERACAO_SEGREDO = 'troque-por-um-texto-longo-e-aleatorio-123!@#';
const RECUPERACAO_MINUTOS = 60; // validade do link

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["raiz"])) {
    $_SESSION["raiz"] = "/loja3a/";
}

if (!isset($_SESSION['estoqueMinimo'])) {
    $_SESSION['estoqueMinimo'] = 5;
}

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

/**
 * Estoque disponível de um produto.
 *
 * disponível = entradas - tudo que já saiu ou está reservado
 *
 * Conta como baixa toda compra que NÃO está cancelada:
 *   - reservado (reserva feita no site, ainda não retirada)
 *   - entregue  (saída registrada pelo SGE / venda física)
 * Compras canceladas devolvem o produto ao estoque.
 */
function estoqueDisponivel(PDO $conn, int $idProduto): int
{
    $sql = "SELECT
                COALESCE((
                    SELECT SUM(e.quantidade)
                    FROM entrada e
                    WHERE e.fk_produto = :id
                ), 0)
                -
                COALESCE((
                    SELECT SUM(cp.quantidade)
                    FROM compra_produto cp
                    JOIN compra c
                        ON c.id_compra = cp.fk_compra
                    WHERE cp.fk_produto = :id
                      AND LOWER(c.status::text) <> 'cancelado'
                ), 0) AS disponivel";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $idProduto]);

    return (int) $stmt->fetchColumn();
}

function Raiz()
{
    if (isset($_SESSION['raiz'])) {
        return str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . $_SESSION['raiz'];
    }
    return str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
}

//FUNÇÕES COMENTADAS ATÉ BAIXAR A BIBLIOTECA PHPMAILER

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

        header('Location: index.php');
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

// Dispara e-mails em HTML utilizando a biblioteca PHPMailer 6 via SMTP.
// Retorna true se enviou, false se falhou (o motivo vai para o error_log).
function EnviaEmail($pEmailDestino, $pAssunto, $pHtml,
                    $pUsuario = "alunocti@efesonet.com",
                    $pSenha = "Cti2025!",
                    $pSMTP = "smtp.kinghost.net")
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $pSMTP;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';
        $mail->Username   = $pUsuario;
        $mail->Password   = $pSenha;
        $mail->setFrom($pUsuario, 'Fruit Bubbles');
        $mail->addAddress($pEmailDestino);
        $mail->isHTML(true);
        $mail->Subject = $pAssunto;
        $mail->Body    = $pHtml;
        $mail->send();
        return true;
    } catch (\Throwable $e) {
        error_log('EnviaEmail: ' . $e->getMessage());
        return false;
    }
}

// ---------------------------------------------------------
// Recuperação de senha
// Token: base64url(email|expiracao) . "." . assinatura HMAC
//  - não pode ser forjado para outro e-mail
//  - expira em RECUPERACAO_MINUTOS
//  - perde a validade assim que a senha muda (uso único)
// ---------------------------------------------------------
function GeraTokenRecuperacao($email, $hashSenhaAtual)
{
    $payload = $email . '|' . (time() + RECUPERACAO_MINUTOS * 60);
    $sig = hash_hmac('sha256', $payload . '|' . $hashSenhaAtual, RECUPERACAO_SEGREDO);
    return rtrim(strtr(base64_encode($payload), '+/', '-_'), '=') . '.' . $sig;
}

// Retorna o e-mail se o token for válido; senão retorna null
function ValidaTokenRecuperacao($conn, $token)
{
    $partes = explode('.', (string) $token);
    if (count($partes) !== 2) return null;

    $payload = base64_decode(strtr($partes[0], '-_', '+/'), true);
    if ($payload === false) return null;

    $pos = strrpos($payload, '|');
    if ($pos === false) return null;

    $email = substr($payload, 0, $pos);
    $exp   = (int) substr($payload, $pos + 1);
    if ($exp < time()) return null;

    $st = $conn->prepare("SELECT senha FROM usuario
                          WHERE email = :e AND (excluido = false OR excluido IS NULL)");
    $st->execute([':e' => $email]);
    $hash = $st->fetchColumn();
    if ($hash === false) return null;

    $esperada = hash_hmac('sha256', $payload . '|' . $hash, RECUPERACAO_SEGREDO);
    return hash_equals($esperada, $partes[1]) ? $email : null;
}

// URL base do site (funciona em /loja3a/, localhost, etc.)
function UrlBaseSite()
{
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $pasta = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return ($https ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $pasta;
}

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