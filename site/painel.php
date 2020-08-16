<?php

include_once("admin/config/conexao.php");

if(!isset($_SESSION['aluno'])){
    echo "<script language='javascript'>window.location='index.php?acao=login'</script>";
}

$res_mat = $pdo->query("select * from materias order by nomemenu");
$materias = $res_mat->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row">
    <div class="col text-right">
        <h3 class="text-white">
            <?=$_SESSION['aluno']?>
            <a href="site/logout.php">
                <i class="fa fa-sign-out ml-3 text-danger fa-lg" aria-hidden="true"></i>
            </a>
        </h3>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4 col-sm-12">
        <?php
            for($i = 0; $i < count($materias); $i++){
                echo "<h3 id='texto-lista'>".$materias[$i]['nomemenu']."</h3>";
                echo "<ul class='list-group list-group-flush'>";
                $materia = $materias[$i]['id'];
                $res_audios = $pdo->query("select * from audios where materiaid = $materia order by id");
                $audios = $res_audios->fetchAll(PDO::FETCH_ASSOC);
                for($j = 0; $j < count($audios); $j++){
                    echo "<li class='list-group-item'>".
                    "<a id='link-site' href='index.php?acao=painel&audio=".$audios[$j]["id"]."'>"
                    .$audios[$j]['nomemenu']."</a></li>";
                }
                echo "</ul>";
            }
        ?>
    </div>
    <div class="col-md-8 col-sm-12 text-center text-white">
            <?php
            if(!isset($_GET['audio'])){?>
            <div class="card ">
                <h3 class="card-title p-3 text-dark ">Selecione um áudio para ouvir.</h3>
                <div class="card-body p-3 ">
                    <h1><i class="fa fa-play-circle-o fa-5x text-primary" aria-hidden="true"></i></h1>
                    <br/>
                </div>
                
            </div>
            <?php } else { ?>
            <div class="card ">
                <?php
                    $id = $_GET['audio'];
                    $res_audio = $pdo->query("select * from audios where id = $id");
                    $audio = $res_audio->fetchAll(PDO::FETCH_ASSOC);
                    $caminho = "admin".DIRECTORY_SEPARATOR."audios".DIRECTORY_SEPARATOR;
                ?>
                <h3 class="card-title p-3 text-dark"><?=$audio[0]["titulo"]?></h3>
                <small class="text-dark"><?=$audio[0]["assunto"]?></small>
                <small class="text-dark"><?=$audio[0]["nivel"]?></small>
                <div class="card-body p-3 ">
                    <h1><i class="fa fa-play-circle-o fa-5x text-primary" aria-hidden="true"></i></h1>
                    <br/>
                    <audio controls class="p-2">
                        <source src="<?=$caminho.$audio[0]["audio"]?>" type="audio/ogg">
                        Seu navegador não suporta áudio tag.
                    </audio>
                </div>
                
            </div>
            <?php }
            ?>
        
    </div>
</div>


