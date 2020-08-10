<?php 

require_once("../config/conexao.php");

$materiaid = $_POST['materiaid'];
$titulo = $_POST['titulo'];
$assunto = $_POST['assunto'];
$nivel = $_POST['nivel'];
$file = $_FILES["fileupload"];
$nomemenu = $_POST['nomemenu'];
$criadoem = date("Y-m-d H:i:s");
$alteradoem = date("Y-m-d H:i:s");

if($file["error"]){
	echo "Erro ao carregar o audio !";
} else {

	$dirUploads = "audiosmat".str_pad($materiaid, 10, "0", STR_PAD_LEFT);
	if(!is_dir($dirUploads)){
		mkdir($dirUploads);
	}

	if(move_uploaded_file($file["tmp_name"],$dirUploads.DIRECTORY_SEPARATOR.$file["name"])){
		$audio = $dirUploads.DIRECTORY_SEPARATOR.$file["name"];

		$res = $pdo->prepare("INSERT into audios (materiaid, titulo, assunto, nivel, audio, nomemenu, createdat, updatedat) 
			values (:materiaid, :titulo, :assunto, :nivel, :audio, :nomemenu, :criadoem, :alteradoem) ");

		$res->bindValue(":materiaid", $materiaid);
		$res->bindValue(":titulo", $titulo);
		$res->bindValue(":assunto", $assunto);
		$res->bindValue(":nivel", $nivel);
		$res->bindValue(":audio", $audio);
		$res->bindValue(":nomemenu", $nomemenu);
		$res->bindValue(":criadoem", $criadoem);
		$res->bindValue(":alteradoem", $alteradoem);

		$res->execute();

		echo "Cadastrado com Sucesso !";
	} else {
		echo "Erro ao fazer o upload do áudio !";
	}
	
}

?>
