<?php

$servidor="localhost";

$usuario="root";

$senha="root";

$base="bptech";

$conn = mysqli_connect($servidor, $usuario, $senha, $base);

	if(!$conn){ die(mysql_error());}

mysqli_set_charset($conn, 'utf8');



$page = basename($_SERVER['SCRIPT_NAME']);

function make_safe($variable) {

	$variable = addslashes($variable); //Adiciona barras invertidas a uma string

	return $variable;

}

?>

