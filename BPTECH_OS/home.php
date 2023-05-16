<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>SisVita - Sistema de Chamados</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
<div class="linha-top"></div>

<?php include "connect.php";
    if (!isset($_SESSION)) session_start();
    $nivel_necessario = 3;
    //$nivel_admin = 1;

    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UserID'])) {
    	session_destroy(); // Destrói a sessão por segurança
    	header("Location: index.php"); // Redireciona o visitante de volta pro login
    	exit;
    }
    $idusuario = $_SESSION['UserID'];
    $nomeusuario = $_SESSION['UserNome'];
    $nivelusuario = $_SESSION['UserNivel'];
    $categoria = 0;

    date_default_timezone_set('America/Sao_Paulo');
?>

<div class="container">

        <div class="col-sm-4 btnhome2 col-xs-offset-2">
            <a href="remoto.php">
				<i class="fa fa-laptop" aria-hidden="true"></i>
                <h1>Acesso Remoto</h1>
            </a>
        </div>

        <div class="col-sm-4 btnhome2">
            <a href="inicial.php">
				<i class="fa fa-file-o" aria-hidden="true"></i>
                <h1>SisVita Chamados</h1>
            </a>
        </div>


</div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</body>
</html>
