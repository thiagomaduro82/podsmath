<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$escolaridadeid = $_POST['escolaridadeid'];
$datanascimento = $_POST['datanascimento'];
$sexo = $_POST['sexo'];
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("UPDATE alunos set nome = :nome,  email = :email, senha = :senha, updatedat = :alteradoem, escolaridadeid = :escolaridadeid, datanascimento = :datanascimento, sexo = :sexo where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":senha", $senha);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":escolaridadeid", $escolaridadeid);
$res->bindValue(":datanascimento", $datanascimento);
$res->bindValue(":sexo", $sexo);
$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso !";

?>