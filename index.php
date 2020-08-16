<?php

$acao = @$_GET['acao'];

if(!isset($acao)){
    $acao = 'dashboard';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="site/css/style.css">
    <title>Podsmath</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg mb-0 pb-0">
        
            <a id="link-site" class="navbar-brand" href="index.php">
                <i class="fa fa-home fa-3x" aria-hidden="true"></i>
            </a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <a class="nav-item nav-link " href="index.php?acao=login">Área do Aluno</a>
                    <a class="nav-item nav-link " href="#">Fale conosco</a>
                    <a class="nav-item nav-link " href="admin/index.php">Administração</a>
                </ul>
            </div>
        
        </nav>
        <hr>
        
        <?php 
            include_once('site'.DIRECTORY_SEPARATOR.$acao.".php");
        ?>

    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4 mt-4">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-white">© 2020 Copyright
           | PODSMATH
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>