<?php
include_once("config/conexao.php");

if(empty($_SESSION["usuario"])){
    header("location:login/login.php");
}

$pagina = "dashboard";

$res_usu = $pdo->query("select count(id) as total from usuarios");
$num_usuarios = $res_usu->fetchAll(PDO::FETCH_ASSOC);

$res_mat = $pdo->query("select count(id) as total from materias");
$num_materias = $res_mat->fetchAll(PDO::FETCH_ASSOC);

$res_aud = $pdo->query("select count(id) as total from audios");
$num_audios = $res_aud->fetchAll(PDO::FETCH_ASSOC);

$res_alu = $pdo->query("select count(id) as total from alunos");
$num_alunos = $res_alu->fetchAll(PDO::FETCH_ASSOC);

$res_duv = $pdo->query("select count(id) as total from duvidas");
$num_duvidas = $res_duv->fetchAll(PDO::FETCH_ASSOC);

$res_duvres = $pdo->query("select count(id) as total from duvidas where status = 'Respondida'");
$num_duvidasres = $res_duvres->fetchAll(PDO::FETCH_ASSOC);

$res_duvnores = $pdo->query("select count(id) as total from duvidas where status = 'Em Aberto'");
$num_duvidasnores = $res_duvnores->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-maroon"><i class="fas fa-tachometer-alt mr-2 "></i>Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-user-friends mr-2"></i> Usuários</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-2">Usuários cadastrados.</h6>

                <p class="card-text">
                  Hoje a plataforma conta com 
                    <span class="pull-right-container ">
							        <span class="label pull-right bg-success p-1 rounded"><?=$num_usuarios[0]["total"]?></span>
						        </span> usuários cadastrados.
                </p>
                <a href="index.php?acao=usuarios" class="btn bg-maroon"><i class="nav-icon fas fa-user-friends mr-2"></i>Usuários</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-scroll mr-2"></i> Matérias</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-2">Matérias relevantes.</h6>

                <p class="card-text">Hoje temos 
                  <span class="pull-right-container ">
							        <span class="label pull-right bg-success p-1 rounded"><?=$num_materias[0]["total"]?></span>
						        </span> matérias cadastradas.
                </p>
                <a href="index.php?acao=materias" class="btn bg-maroon"><i class="nav-icon fas fa-scroll mr-2"></i>Matérias</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-headset mr-2"></i>Áudios</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-2">Qualidade em primeiro lugar.</h6>

                <p class="card-text">
                  Contamos com 
                  <span class="pull-right-container ">
                    <span class="label pull-right bg-success p-1 rounded"><?=$num_audios[0]["total"]?></span>
                  </span> áudios na nossa base de dados.
                </p>
                <a href="index.php?acao=audios" class="btn bg-maroon"><i class="nav-icon fas fa-headset mr-2"></i>Áudios</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-user-graduate mr-2"></i>Alunos</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Atenção especial.</h6>

                <p class="card-text">
                  Temos atualmente 
                  <span class="pull-right-container ">
                    <span class="label pull-right bg-success p-1 rounded"><?=$num_alunos[0]["total"]?></span>
                  </span>
                  alunos na nossa plataforma.
                </p>
                <a href="index.php?acao=alunos" class="btn bg-maroon"><i class="nav-icon fas fa-user-graduate mr-2"></i>Alunos</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-question-circle mr-2"></i>Dúvidas</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Time de especialistas.</h6>

                <p class="card-text">
                  Interagimos no momento com 
                  <span class="pull-right-container ">
                    <span class="label pull-right bg-success p-1 rounded"><?=$num_duvidas[0]["total"]?></span>
                  </span>
                  dúvidas.
                </p>
                <a href="index.php?acao=duvidas" class="btn bg-maroon"><i class="nav-icon fas fa-question-circle mr-2"></i>Dúvidas</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0 text-maroon"><i class="nav-icon fas fa-chart-line mr-2"></i>Estatística</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Analisamos esses números.</h6>

                <p class="card-text">
                  Temos 
                  <span class="pull-right-container ">
                    <span class="label pull-right bg-success p-1 rounded"><?=$num_duvidasres[0]["total"]?></span>
                  </span> respondidas e 
                  <span class="pull-right-container ">
                    <span class="label pull-right bg-success p-1 rounded"><?=$num_duvidasnores[0]["total"]?></span>
                  </span> em aberto.
                </p>
                <a href="index.php?acao=duvidas" class="btn bg-maroon"><i class="nav-icon fas fa-question-circle mr-2"></i>Dúvidas</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->