<?php 

require_once("../config/conexao.php");
$pagina = 'duvidas';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table table-bordered table-sm mt-3 tabelas">
	<thead class="thead-light">
		<tr>
			<th scope="col">Aluno</th>
			<th scope="col">Pergunta</th>
			<th scope="col">Resposta</th>
			<th scope="col">Status</th>
			<th scope="col">Data Perg.</th>
			<th scope="col">Data Resp.</th>
			<th scope="col" class="text-center">Ações</th>
		</tr>
	</thead>
	<tbody>';

	
	    $itens_por_pagina = $_POST['itens'];

	//PEGAR A PÁGINA ATUAL
		$pagina_pag = intval(@$_POST['pag']);
		
		$limite = $pagina_pag * $itens_por_pagina;

		//CAMINHO DA PAGINAÇÃO
		$caminho_pag = 'index.php?acao='.$pagina.'&';

	if($txtbuscar == ''){
		$res = $pdo->query("SELECT d.*, p.alunoid, p.audioid, a.nome 
		from duvidas as d, playlists as p, alunos as a 
		where (d.playlistid = p.id) and (p.alunoid = a.id)  
		order by p.id desc LIMIT $limite, $itens_por_pagina");
	}else{
		$txtbuscar = '%'.@$_POST['txtbuscar'].'%';
		$res = $pdo->query("SELECT d.*, p.*, a.nome  
		from duvidas as d, playlists as p, alunos as a  
		where (d.playlistid = p.id) and (p.alunoid = a.id) and ((a.nome LIKE '$txtbuscar') or (p.status LIKE '$txtbuscar')) order by p.id desc");

	}
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);


	//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from duvidas");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

		//DEFINIR O TOTAL DE PAGINAS
		$num_paginas = ceil($num_total/$itens_por_pagina);


	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$aluno = $dados[$i]['nome'];
			$pergunta = $dados[$i]['pergunta'];
			$resposta = $dados[$i]['resposta'];
			$status = $dados[$i]['status'];
			$data_pergunta = date("d/m/Y", strtotime($dados[$i]['createdat']));
			if(isset($dados[$i]['updatedat'])){
				$data_resposta = date("d/m/Y", strtotime($dados[$i]['updatedat']));
			} else {
				$data_resposta = "";
			}
			
	
			if($dados[$i]['status'] == 'Em Aberto') {
				echo '
				<tr>
					<td>'.$aluno.'</td>
					<td>'.$pergunta.'</td>
					<td>'.$resposta.'</td>
					<td class="text-center">
						<span class="pull-right-container ">
							<span class="label pull-right bg-danger p-1 rounded">'.$status.'</span>
						</span>
					</td>
					<td>'.$data_pergunta.'</td>
					<td>'.$data_resposta.'</td>
					<td class="text-center">
						<a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'" title="Responder"><i class="fa fa-edit fa-lg text-info"></i></a>
					</td>
				</tr>';
		
			} else if($dados[$i]['status'] == 'Respondida') {
				echo '
				<tr>
					<td>'.$aluno.'</td>
					<td>'.$pergunta.'</td>
					<td>'.$resposta.'</td>
					<td class="text-center">
						<span class="pull-right-container ">
							<span class="label pull-right bg-success p-1 rounded">'.$status.'</span>
						</span>
					</td>
					<td>'.$data_pergunta.'</td>
					<td>'.$data_resposta.'</td>
					<td class="text-center">
						<a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'" title="Responder"><i class="fa fa-edit fa-lg text-info"></i></a>
					</td>
				</tr>';
			}
		}
            


echo  '
	</tbody>
</table> ';


if($txtbuscar == ''){


echo '
<!--ÁREA DA PÁGINAÇÃO -->
<nav class="paginacao" aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm mr-1" href="'.$caminho_pag.'pagina=0&itens='.$itens_por_pagina.'" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>';
            
            for($i=0;$i<$num_paginas;$i++){
            $estilo = "";
            if($pagina_pag == $i)
              $estilo = "active";

          echo '
             <li class="page-item"><a class="btn btn-outline-dark btn-sm mr-1 '.$estilo.'" href="'.$caminho_pag.'pagina='.$i.'&itens='.$itens_por_pagina.'">'.($i+1).'</a></li>';
           } 
            
           echo '<li class="page-item">
              <a class="btn btn-outline-dark btn-sm" href="'.$caminho_pag.'pagina='.($num_paginas-1).'&itens='.$itens_por_pagina.'" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
</nav>




';

}


?>