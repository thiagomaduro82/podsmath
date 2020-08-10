<?php 

require_once("../config/conexao.php");

$nome = $_POST['nome'];
$nomemenu = $_POST['nomemenu'];
$criadoem = date("Y-m-d H:i:s");
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("INSERT into materias (nome, nomemenu, createdat, updatedat) 
		values (:nome, :nomemenu, :criadoem, :alteradoem) ");

$res->bindValue(":nome", $nome);
$res->bindValue(":nomemenu", $nomemenu);
$res->bindValue(":criadoem", $criadoem);
$res->bindValue(":alteradoem", $alteradoem);

$res->execute();

echo "Cadastrado com Sucesso !";


?>