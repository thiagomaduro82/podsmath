<?php

include_once("config/conexao.php");

if(empty($_SESSION["usuario"])){
    header("location:login/login.php");
}

$pagina = "playlists";

?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row justify-content-center m-0 p-0">
			<div class="col-md-10 col-ms-12">
			<h3 class="m-0 text-maroon"><i class="nav-icon fas fa-file-audio mr-3"></i>Playlists</h3>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="row justify-content-center m-0 p-0">
	<div class="col-md-10 col-ms-12 ">
		<div class="card card-primary card-outline m-3 shadow">
			<div class="card-body">
				<div class="row mt-1">
					<div class="col-md-6 col-sm-12">
						<div class="float-left">
							<form method="post">
								<select id="itens-pagina" onChange="submit();" class="form-control-sm" id="exampleFormControlSelect1" name="itens-pagina">
									<?php 
									if(isset($_POST['itens-pagina'])){
										$item_paginado = $_POST['itens-pagina'];
									}elseif(isset($_GET['itens'])){
										$item_paginado = $_GET['itens'];
									}
									?>
									<option value="<?php echo @$item_paginado ?>"><?php echo @$item_paginado ?> Registros</option>
									<?php if(@$item_paginado != $opcao1){ ?> 
										<option value="<?php echo $opcao1 ?>"><?php echo $opcao1 ?> Registros</option>
									<?php } ?>
									<?php if(@$item_paginado != $opcao2){ ?> 
										<option value="<?php echo $opcao2 ?>"><?php echo $opcao2 ?> Registros</option>
									<?php } ?>
									<?php if(@$item_paginado != $opcao3){ ?> 
										<option value="<?php echo $opcao3 ?>"><?php echo $opcao3 ?> Registros</option>
									<?php } ?>
								</select>
							</form>
						</div>
					</div>
					<?php 

					//DEFINIR O NUMERO DE ITENS POR PÁGINA
					if(isset($_POST['itens-pagina'])){
						$itens_por_pagina = $_POST['itens-pagina'];
						@$_GET['pagina'] = 0;
					}elseif(isset($_GET['itens'])){
						$itens_por_pagina = $_GET['itens'];
					}
					else{
						$itens_por_pagina = $opcao1;
					}
					?>
					
					<div class="col-md-6 col-sm-12">
						<div class="float-right">
							<form id="frm" class="form-inline my-2 my-lg-0" method="post">
								<input type="hidden" id="pag"  name="pag" value="<?php echo @$_GET['pagina'] ?>">
								<input type="hidden" id="itens"  name="itens" value="<?php echo @$itens_por_pagina; ?>">
								<input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Aluno" aria-label="Search" name="txtbuscar" id="txtbuscar">
								<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar" id="btn-buscar"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>    
				</div>
				<div id="listar">

				</div>
			<!-- fim do corpo do card -->
			</div>
		</div>

	</div>
</div>

<!--CHAMADA DA MODAL VISUALIZAR -->
<?php 
if(@$_GET['funcao'] == 'visualizar' && @$item_paginado == ''){ 
	$id = $_GET['id'];
	$consulta = "SELECT p.*, a.*, au.*, e.descricao, m.nome as materia
	from playlists as p, alunos as a, audios as au, escolaridade as e, materias as m 
	where (p.alunoid = a.id) and (p.audioid = au.id) and (a.escolaridadeid = e.id) and (au.materiaid = m.id) 
	and (p.id = $id)";
	$result = $pdo->query($consulta);
	$dados = $result->fetchAll(PDO::FETCH_ASSOC);
	$tocar = "audios".DIRECTORY_SEPARATOR.$dados[0]['audio'];
	?>
	<div class="modal" id="modal-visualizar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header p-2">
				<h5 class="modal-title text-success">
					<i class="far fa-list-alt fa-lg mr-2"></i>
					Visualizar dados.
				</h5>
				</div>
				<div class="modal-body">
					<strong class="modal-title text-primary"><?=$dados[0]["nome"]?></strong><br />
					<strong>E-mail: </strong><?=$dados[0]["email"]?> - <strong>Sexo: </strong><?=$dados[0]["sexo"]?><br />
					<strong>Nascimento: </strong><?=date("d/m/Y", strtotime($dados[0]["datanascimento"]))?> - <strong>Escolaridade: </strong><?=$dados[0]["descricao"]?><br /><br />
					<strong class="modal-title text-primary"><?=$dados[0]["titulo"]?></strong><br />
					<strong>Matéria: </strong><?=$dados[0]["materia"]?> - <strong>Nível: </strong><?=$dados[0]["nivel"]?><br />
					<strong>Assunto:</strong>
					<p><?=$dados[0]["assunto"]?></p>
					<audio controls>
						<source src="<?=$tocar?>" type="audio/ogg">
						Seu navegador não suporta áudio tag.
					</audio>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal" id="btn-cancelar-excluir">Voltar</button>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>

<script>$('#modal-visualizar').modal("show");</script>

<!--AJAX PARA BUSCAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar').html(result)
					
				},
			})
		})
	})
</script>

<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$.ajax({
			url: pag + "/listar.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar').html(result)

			},
		})
	})
</script>
<!--AJAX PARA BUSCAR OS DADOS PELA TXT -->
<script type="text/javascript">
	$('#txtbuscar').keyup(function(){
		$('#btn-buscar').click();
	})
</script>

