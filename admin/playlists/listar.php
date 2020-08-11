<?php 

require_once("../config/conexao.php");
$pagina = 'alunos';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table table-bordered table-sm mt-3 tabelas">
	<thead class="thead-light">
		<tr>
			<th scope="col">Aluno</th>
			<th scope="col">Áudio</th>
			<th scope="col">Primeiro Acesso</th>
			<th scope="col">Último Acesso</th>
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
		$res = $pdo->query("SELECT p.*, a.nome, au.titulo 
		from playlists as p, alunos as a, audios as au  
		where (p.alunoid = a.id) and (p.audiois = au.id) order by id desc LIMIT $limite, $itens_por_pagina");
	}else{
		$txtbuscar = '%'.@$_POST['txtbuscar'].'%';
		$res = $pdo->query("SELECT a.*, e.descricao  
		from alunos as a, escolaridade as e 
		where (a.escolaridadeid = e.id) and (nome LIKE '$txtbuscar' or email LIKE '$txtbuscar') order by id desc");

	}
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);


	//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from alunos");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

		//DEFINIR O TOTAL DE PAGINAS
		$num_paginas = ceil($num_total/$itens_por_pagina);


	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$email = $dados[$i]['email'];	
			$datanascimento = date("d/m/Y", strtotime($dados[$i]['datanascimento']));	
			$sexo = $dados[$i]['sexo'];	
			$escolaridade = $dados[$i]['descricao'];			

echo '
		<tr>
			<td>'.$nome.'</td>
			<td>'.$email.'</td>
			<td>'.$datanascimento.'</td>
			<td>'.$sexo.'</td>
			<td>'.$escolaridade.'</td>
			<td class="text-center">
				<a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'" title="Alterar dados"><i class="fa fa-edit fa-lg text-info"></i></a>
				<a href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'" title="Excluir dados"><i class="fa fa-trash fa-lg text-danger"></i></a>
			</td>
		</tr>';

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