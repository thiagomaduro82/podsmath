<?php 

require_once("../config/conexao.php");

$descricao = $_POST['descricao'];

$res = $pdo->prepare("INSERT into escolaridade (descricao) 
		values (:descricao) ");

$res->bindValue(":descricao", $descricao);

$res->execute();

echo "Cadastrado com Sucesso !";


?>