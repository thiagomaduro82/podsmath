<?php

include_once("../config/conexao.php");
@session_destroy();
header("location:../index.php?acao=login");

?>
