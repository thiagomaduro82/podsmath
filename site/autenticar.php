<?php

include_once("../admin/config/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];
$opcao = @$_POST["opcao"];

if(empty($email) || empty($senha))
{
    echo "<script language='javascript'>window.location='login.php'</script>";
} else {
    if(!isset($opcao)){
        $res = $pdo->prepare("SELECT * FROM alunos where email = :email and senha = :senha ");
        $res->bindValue("email", $email);
        $res->bindValue("senha", $senha);
        $res->execute();
    
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    
        $linha = count($dados);
    
        if($linha > 0) {
            $_SESSION["aluno"] = $dados[0]["nome"];
            $_SESSION["email"] = $dados[0]["email"];
            echo "<script language='javascript'>window.location='../index.php?acao=painel'</script>";    
        } else {
            echo "<script language='javascript'>window.alert('Dados incorretos !')</script>";
            echo "<script language='javascript'>window.location='../index.php?acao=login'</script>";
        }
    } else if ($opcao == "C"){
        echo "<script language='javascript'>window.location='../index.php?acao=cadastro'</script>";
    } else if ($opcao == "E"){
        echo "<script language='javascript'>window.location='../index.php?acao=login'</script>";
    }
    
}

?>