<?php
if (!isset($_SESSION)) session_start();
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UserID'])) {
    session_destroy(); // Destrói a sessão por segurança
    header("Location: index.php"); // Redireciona o visitante de volta pro login
    exit;
}
if ($_SESSION['UserNivel'] <= '2' && $_SESSION['UserTipo'] === '1') {


include "../connect.php";
$r = $_GET['r'];
$t = $_GET['t'];

if($t === 'set'){
    $rem1 = $conn->query("DELETE FROM setores WHERE id = ".$r);
    $rem2 = $conn->query("DELETE FROM atividades WHERE setor = ".$r);
    echo "<script>alert('Setor removido!'); </script>";
    echo "<script> location.href='../setores.php';</script>";
} else if($t === 'ati'){
    $rem1 = $conn->query("DELETE FROM atividades WHERE id = ".$r);
    echo "<script>alert('Atividade removida!'); </script>";
    echo "<script> location.href='../atividades.php';</script>";
} else if($t === 'col'){
    $rem1 = $conn->query("DELETE FROM usuarios WHERE id = ".$r);
    $rem2 = $conn->query("DELETE FROM usuario_setor WHERE usuario = ".$r) or die ( mysqli_error($conn));
    echo "<script>alert('Colaborador removido!'); </script>";
    echo "<script> location.href='../colaboradores.php';</script>";
} else if($t === 'cli'){
    $rem1 = $conn->query("DELETE FROM clientes WHERE id = ".$r);
    echo "<script>alert('Cliente removido!'); </script>";
    echo "<script> location.href='../clientes.php';</script>";
} else if($t === 'for'){
    $rem1 = $conn->query("DELETE FROM fornecedores WHERE id = ".$r);
    echo "<script>alert('Fornecedor removido!'); </script>";
    echo "<script> location.href='../fornecedores.php';</script>";
}





}
?>
