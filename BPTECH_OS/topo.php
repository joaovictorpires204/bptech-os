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
    $tipoacesso = $_SESSION['UserTipo'];
    $emailusuario = $_SESSION['UserMail'];

    date_default_timezone_set('America/Sao_Paulo');
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
	<title>BPTECH - Sistema de Chamados</title>
	<link rel="shortcut icon" type="image/x-icon" href="./images/ICON.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/estilos.css">
    <meta name="robots" content="noindex, nofollow">
</head>
<body>


<div id="wrapper">
    <?php include "barratopo.php"; ?>
    <?php include "sidebar.php"; ?>

    <div id="page-wrapper" class="wrapper">
