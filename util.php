<?php


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


?>

