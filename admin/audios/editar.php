<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$materiaid = $_POST['materiaid'];
$titulo = $_POST['titulo'];
$assunto = $_POST['assunto'];
$nivel = $_POST['nivel'];
$nomemenu = $_POST['nomemenu'];
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("UPDATE audios set materiaid = :materiaid, titulo = :titulo, assunto = :assunto, updatedat = :alteradoem, nivel = :nivel, nomemenu = :nomemenu where id = :id ");

$res->bindValue(":materiaid", $materiaid);
$res->bindValue(":titulo", $titulo);
$res->bindValue(":assunto", $assunto);
$res->bindValue(":nivel", $nivel);
$res->bindValue(":nomemenu", $nomemenu);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso !";

?>