<?php 

require_once("../config/conexao.php");

$id = $_POST['id'];

$res = $pdo->query("DELETE from alunos where id = '$id' ");

?>