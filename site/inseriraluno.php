<?php 

include_once("../admin/config/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$escolaridadeid = $_POST['escolaridadeid'];
$datanascimento = $_POST['datanascimento'];
$sexo = $_POST['sexo'];
$criadoem = date("Y-m-d H:i:s");
$alteradoem = date("Y-m-d H:i:s");

$res = $pdo->prepare("INSERT into alunos (nome, email, senha, createdat, updatedat, escolaridadeid, datanascimento, sexo) 
		values (:nome, :email, :senha, :criadoem, :alteradoem, :escolaridadeid, :datanascimento, :sexo) ");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":senha", $senha);
$res->bindValue(":criadoem", $criadoem);
$res->bindValue(":alteradoem", $alteradoem);
$res->bindValue(":escolaridadeid", $escolaridadeid);
$res->bindValue(":datanascimento", $datanascimento);
$res->bindValue(":sexo", $sexo);

$res->execute();

echo "<script language='javascript'>window.alert('Cadastrado com sucesso - faça seu login !')</script>";
echo "<script language='javascript'>window.location='../index.php?acao=login'</script>";

?>
