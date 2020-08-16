<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$resposta = $_POST['resposta'];
$usuarioid = $_POST['usuarioid'];
$status = "Respondida";
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("UPDATE duvidas set resposta = :resposta,  usuarioid = :usuarioid, status = :status, updatedat = :alteradoem where id = :id ");

$res->bindValue(":resposta", $resposta);
$res->bindValue(":usuarioid", $usuarioid);
$res->bindValue(":status", $status);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":id", $id);

$res->execute();

echo "Respondida com Sucesso !";

?>