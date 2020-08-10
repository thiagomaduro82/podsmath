<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("UPDATE usuarios set nome = :nome,  email = :email, senha = :senha, updatedat = :alteradoem where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":senha", $senha);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso !";

?>