<?php 

require_once("../config/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$criadoem = date("Y-m-d H:i:s");
$alteradoem = date("Y-m-d H:i:s");

//VERIFICAR SE O EMAIL INFORMADO JÁ ESTÁ CADASTRADO
$res_c = $pdo->query("select * from usuarios where email = '$email'");
$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_c);
if($linhas == 0){
	$res = $pdo->prepare("INSERT into usuarios (nome, email, senha, createdat, updatedat) 
            values (:nome, :email, :senha, :criadoem, :alteradoem) ");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":senha", $senha);
	$res->bindValue(":criadoem", $criadoem);
    $res->bindValue(":alteradoem", $alteradoem);

	$res->execute();

	echo "Cadastrado com Sucesso !";

}else{
	echo "Este e-mail já está cadastrado !";
}

?>