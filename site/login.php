<div class="row justify-content-center mt-4">
    <div class="col-md-4 col-ms-12">
    <h2 class="text-white text-center">Identifique-se</h2>
        <form action="site/autenticar.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="email" style="color: #FF1493;">E-mail</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="senha" style="color: #FF1493;">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control form-control-lg">
            </div>
            <div class="form-check">              
            <input class="form-check-input" type="radio" name="opcao" id="exampleRadios1" value="C">
                <label for="cadastrar" style="color: #FF1493;" class="form-check-label">Não sou cadastrado.</label>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary form-control">Enviar</button>
                <button type="reset" class="btn btn-info form-control mt-4">Limpar</button>
            </div>
        </form>

    </div>
</div>