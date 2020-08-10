<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$descricao = $_POST['descricao'];

$res = $pdo->prepare("UPDATE escolaridade set descricao = :descricao where id = :id ");

$res->bindValue(":descricao", $descricao);
$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso !";

?>