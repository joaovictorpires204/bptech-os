<?php
	include "connect.php";
	$codigo = mysqli_real_escape_string($conn, $_REQUEST['id']);

	echo '<option value="0">Todos</option>';

	$sql = "SELECT DISTINCT usuarios.* FROM usuarios INNER JOIN usuario_setor ON ((usuario_setor.setor = $codigo AND usuario_setor.usuario = usuarios.id) OR $codigo = 0) ORDER BY nome";
	$res = $conn->query( $sql )or die ( mysqli_error($conn));
	while ( $row2 = $res->fetch_assoc() ) {
		echo '<option value="'.$row2['id'].'">'.$row2['nome'].'</option>';
	}


?>
