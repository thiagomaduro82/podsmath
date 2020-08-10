<?php

include_once("../config/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

if(empty($email) || empty($senha))
{
    echo "<script language='javascript'>window.location='login.php'</script>";
} else {
    $res = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha ");
    $res->bindValue("email", $email);
    $res->bindValue("senha", $senha);
    $res->execute();

    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    $linha = count($dados);

    if($linha > 0) {
        $_SESSION["usuario"] = $dados[0]["nome"];
        echo "<script language='javascript'>window.location='../index.php'</script>";    
    } else {
        echo "<script language='javascript'>window.alert('Dados incorretos !')</script>";
        echo "<script language='javascript'>window.location='login.php'</script>";
    }
}

?>
