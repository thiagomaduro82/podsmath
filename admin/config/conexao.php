<?php
@session_cache_expire(240);
@session_start();

include_once("config.php");

try {
    $pdo = new PDO("mysql:dbname=$banco_de_dados;host=$host","$usuario","$senha");
} catch (Exception $e) {
    echo "Erro ao conectar com o banco de dados ! " . $e;
}

?>
