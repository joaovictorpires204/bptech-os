<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>MS HELP - Sistema de Suporte Monsat</title>
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
    <div class="col-lg-12 text-center titulo">
        <h1>
        </h1>
    </div>

	<div class="col-xs-12 btnhome">
		<a href="https://www.teamviewer.com/pt/" target="_blank">
			<h1>Acesso Remoto</h1>
			<p>Clique para acessar o site do TeamViewer e baixar um software para realizar o acesso remoto.</p>
		</a>
	</div>

	<div class="col-xs-12 btnhome">
		<a href="inicial.php">
			<h1>Acessar MS HELP</h1>
		</a>
	</div>

</div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</body>
</html>
