<?php

include_once("admin/config/conexao.php");

?>

<div class="row justify-content-center mt-4">
    <div class="col-md-4 col-ms-12">
    <h2 class="text-white text-center">Cadastre-se</h2>
        <form action="site/inseriraluno.php" method="post" class="mt-4">
        
            <div class="form-group">
                <label for="nome" style="color: #FF1493;">Nome</label>
                <input type="text" class="form-control form-control-lg" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email" style="color: #FF1493;">E-mail</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha" style="color: #FF1493;">Senha</label>
                <input type="password" class="form-control form-control-lg" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="datanascimento" style="color: #FF1493;">Data Nascimento</label>
                <input type="date" class="form-control form-control-lg" id="datanascimento" name="datanascimento" required>
            </div>
            <div class="form-group">
                <label for="sexo" style="color: #FF1493;">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" require>
                    <option value="F">Feminino</option>
                    <option value="M">Masculino</option>
                </select>
            </div>
            <div class="form-group">
                <label for="escolaridadeid" style="color: #FF1493;">Escolaridade</label>
                <select name="escolaridadeid" id="escolaridadeid" class="form-control">
                    <?php 
                        $res_prod = $pdo->query("SELECT * from escolaridade order by id asc");
                        $dados_prod = $res_prod->fetchAll(PDO::FETCH_ASSOC); 
                        for($p = 0; $p < count($dados_prod); $p++){
                            echo "<option value='".$dados_prod[$p]['id']."'>".$dados_prod[$p]['descricao']."</option>";
                        }
                    ?> 
                </select>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary form-control">Enviar</button>
                <button type="reset" class="btn btn-info form-control mt-4">Limpar</button>
            </div>
        </form>
    </div>
</div>