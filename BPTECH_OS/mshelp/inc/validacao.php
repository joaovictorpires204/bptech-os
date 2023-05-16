<?php
// Verifica se houve POST e se o usuário ou a senha é vazio
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: ../index.php?erro"); exit;
}

include "../connect.php";
mysqli_set_charset($conn, 'utf8');

$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

// Validação do usuário/senha digitados
// ver se é um colaborador da monsat
$sql = "SELECT * FROM `usuarios` WHERE (`usuario` = '". $usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
$query = $conn->query( $sql ) or die ( mysqli_error($conn));
if (mysqli_num_rows($query) != 1) {
// Se usuário não for encontrado é direcionado para página de login

	// Busca na tabela clientes
	$sql = "SELECT `id`, `cliente`, `email1` FROM `clientes` WHERE (`usuario` = '". $usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
	$query2 = $conn->query( $sql ) or die ( mysqli_error($conn));
	if (mysqli_num_rows($query2) != 1) {
		//se não encontrar a busca no clientes, busca em fornecedores
		$sql = "SELECT `id`, `fornecedor`, `email1` FROM `fornecedores` WHERE (`usuario` = '". $usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
		$query3 = $conn->query( $sql ) or die ( mysqli_error($conn));
		if (mysqli_num_rows($query3) != 1) {

		// Caso não encontre nem em usuarios, nem em clientes, nem em fornecedores - redireciona para a tela de login
			header("Location: ../index.php?erro"); exit;

		} else{
			// se encontrou algum fornecedor:
			$resultado = $query3->fetch_assoc(); // Salva os dados encontados na variável $resultado
			if (!isset($_SESSION)) session_start(); // Se a sessão não existir, inicia uma
			// Salva os dados encontrados na sessão
			$_SESSION['UserID'] = $resultado['id'];
			$_SESSION['UserNome'] = $resultado['fornecedor'];
			$_SESSION['UserMail'] = $resultado['email1'];
			$_SESSION['UserTipo'] = '3';
			$_SESSION['UserNivel'] = '5';
			$idusuario = $resultado['id'];

			$sql1 = $conn->query("INSERT INTO `usuario_login`(`usuario`, `tipo`) VALUES ('".$idusuario."', '3');"); // registro de login

			// Redireciona o visitante
			header("Location: ../home.php"); exit;
		}

	} else {
		// se encontrou algum cliente:
		$resultado = $query2->fetch_assoc(); // Salva os dados encontados na variável $resultado
		if (!isset($_SESSION)) session_start(); // Se a sessão não existir, inicia uma
		// Salva os dados encontrados na sessão
		$_SESSION['UserID'] = $resultado['id'];
		$_SESSION['UserNome'] = $resultado['cliente'];
		$_SESSION['UserMail'] = $resultado['email1'];
		$_SESSION['UserTipo'] = '2';
		$_SESSION['UserNivel'] = '5';
		$idusuario = $resultado['id'];
		echo $idusuario;

		$sql1 = $conn->query("INSERT INTO `usuario_login`(`usuario`, `tipo`) VALUES ('".$idusuario."', '2');") or die ( mysqli_error($conn)); // registro de login

		//break;
		// Redireciona o visitante
		header("Location: ../home.php"); exit;
	}
} else {
	// se encontrou algum colaborador:
	$resultado = $query->fetch_assoc(); // Salva os dados encontados na variável $resultado

	date_default_timezone_set('America/Sao_Paulo');
	$dia = date('w');
	$hora = date('H:i');

	if($dia === '0'){
		$resula = $resultado['dom1'];
		$resulb = $resultado['dom2'];
	} else if ($dia === '1'){
		$resula = $resultado['seg1'];
		$resulb = $resultado['seg2'];
	} else if ($dia === '2'){
		$resula = $resultado['ter1'];
		$resulb = $resultado['ter2'];
	} else if ($dia === '3'){
		$resula = $resultado['qua1'];
		$resulb = $resultado['qua2'];
	} else if ($dia === '4'){
		$resula = $resultado['qui1'];
		$resulb = $resultado['qui2'];
	} else if ($dia === '5'){
		$resula = $resultado['sex1'];
		$resulb = $resultado['sex2'];
	} else if ($dia === '6'){
		$resula = $resultado['sab1'];
		$resulb = $resultado['sab2'];
	}

	if ($resula <= $hora && $resulb >= $hora) {

		if (!isset($_SESSION)) session_start(); // Se a sessão não existir, inicia uma
		// Salva os dados encontrados na sessão
		$_SESSION['UserID'] = $resultado['id'];
		$_SESSION['UserNome'] = $resultado['nome'];
		$_SESSION['UserNivel'] = $resultado['nivel'];
		$_SESSION['UserMail'] = $resultado['email'];
		$idusuario = $resultado['id'];
		$_SESSION['UserTipo'] = '1';

		$sql1 = $conn->query("INSERT INTO `usuario_login`(`usuario`, `tipo`) VALUES ('".$idusuario."', '1');"); // registro de login

		// Redireciona o visitante
		header("Location: ../home.php"); exit;

	} else {
		// Caso não tenha permissao pra acessar esse horario
		header("Location: ../index.php?horario"); exit;
	}
}
?>
