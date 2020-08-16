<?php

include_once("config/conexao.php");

if(empty($_SESSION["usuario"])){
    header("location:login/login.php");
}

$pagina = "duvidas";

?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row m-0 p-0">
			<div class="col-md-12 col-ms-12">
			<h3 class="m-0 text-maroon"><i class="nav-icon fas fa-question-circle mr-3"></i>Dúvidas</h3>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<div class="row m-0 p-0">
	<div class="col-md-12 col-ms-12 ">
		<div class="card card-primary card-outline m-3 shadow">
			<div class="card-body">
				<a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
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

								<input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Descrição" aria-label="Search" name="txtbuscar" id="txtbuscar">
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

		<!-- Modal -->
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header p-2">
						<h5 class="modal-title text-primary" id="exampleModalLabel">
							<?php if(@$_GET['funcao'] == 'editar'){
								$nome_botao = 'Responder';
								$id_reg = $_GET['id'];
								//BUSCAR DADOS DO REGISTRO A SER EDITADO
								$res = $pdo->query("select * from duvidas where id = '$id_reg'");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);
                                $pergunta = $dados[0]['pergunta'];
                                $resposta = $dados[0]['resposta'];
                                $usuarioid = $dados[0]['usuarioid'];
								echo 'Respondendo Pergunta';
							}else{
								$nome_botao = 'Salvar';
								echo 'Cadastro de Escolaridades';
							} ?>
						</h5>
					</div>
					<div class="modal-body">
						<form method="post">
                            <div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label>Pergunta: </label>
                                        <p><?=@$pergunta?></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<input type="hidden" id="id"  name="id" value="<?php echo @$id_reg ?>" required>
                                        <label for="resposta">Resposta</label>
                                        <textarea name="resposta" id="resposta" class="form-control" cols="30" rows="5"><?=@$resposta?></textarea>
									</div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label for="usuarioid">Respondido por: </label>
                                        <select name="usuarioid" id="usuarioid" class="form-control">
											<?php 
												$res_prod = $pdo->query("SELECT * from usuarios order by id asc");
												$dados_prod = $res_prod->fetchAll(PDO::FETCH_ASSOC);
												if(@$_GET['funcao'] == 'editar'){ 
													for($p = 0; $p < count($dados_prod); $p++){
														if($usuarioid == $dados_prod[$p]['id']){
															echo "<option value='".$dados_prod[$p]['id']."' selected>".$dados_prod[$p]['nome']."</option>";
														} else {
															echo "<option value='".$dados_prod[$p]['id']."'>".$dados_prod[$p]['nome']."</option>";
														}
													}
											?>
											<?php } else { 
												for($p = 0; $p < count($dados_prod); $p++){
													echo "<option value='".$dados_prod[$p]['id']."'>".$dados_prod[$p]['nome']."</option>";
												}
											}?> 
										</select>
									</div>
								</div>
							</div>
							<div id="mensagem" class="">
								<!--Aqui entra as mensagens via Ajax-->
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button name="<?php echo $nome_botao ?>" id="<?php echo $nome_botao ?>" class="btn btn-primary"><?php echo $nome_botao ?></button>
					</div>
				</div>
			</div>
		</div>
    </div>

</div>

<!--CHAMADA DA MODAL NOVO -->
<?php 
if(@$_GET['funcao'] == 'novo' && @$item_paginado == ''){ 
	?>
	<script>$('#btn-novo').click();</script>
<?php } ?>
<!--CHAMADA DA MODAL EDITAR -->
<?php 
if(@$_GET['funcao'] == 'editar' && @$item_paginado == ''){ 
	
	?>
	<script>$('#btn-novo').click();</script>
<?php } ?>

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

<!--AJAX PARA EDIÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#Responder').click(function(event){
			event.preventDefault();
			$.ajax({
				url: pag + "/editar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){
					$('#mensagem').removeClass()
					if(mensagem == 'Respondida com Sucesso !'){
						$('#mensagem').addClass('mensagem-sucesso')
						$('#resposta').val('')
						$('#txtbuscar').val('')
						$('#btn-buscar').click()
						$('#btn-fechar').click()
					}else{
						$('#mensagem').addClass('mensagem-erro')
					}
					$('#mensagem').text(mensagem)
				},
			})
		})
	})
</script>

