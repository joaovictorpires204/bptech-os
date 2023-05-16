<?php
	include "connect.php";
	$codigo = mysqli_real_escape_string($conn, $_REQUEST['id']);

	echo '<option value="0" disabled selected>Selecione</option>';

	$sql = "SELECT * FROM atividades WHERE setor = $codigo AND ativo = 1 ORDER BY atividade";
	$res = $conn->query( $sql )or die ( mysqli_error($conn));
	while ( $row2 = $res->fetch_assoc() ) {
		echo '<option value="'.$row2['id'].'">'.$row2['atividade'].'</option>';
	}


?>
