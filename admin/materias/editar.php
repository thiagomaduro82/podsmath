<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$nomemenu = $_POST['nomemenu'];
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("UPDATE materias set nome = :nome,  nomemenu = :nomemenu, updatedat = :alteradoem where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":nomemenu", $nomemenu);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso !";

?>