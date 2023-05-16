<?php
if (!isset($_SESSION)) session_start();
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UserID'])) {
    session_destroy(); // Destrói a sessão por segurança
    header("Location: index.php"); // Redireciona o visitante de volta pro login
    exit;
}
if ($_SESSION['UserTipo'] === '1') {

include "connect.php";
$cod = $_GET['c'];
$idusuario = $_GET['u'];

$sqle = "SELECT * FROM email WHERE id = '1'";
$rese = $conn->query( $sqle ) or die ( mysqli_error($conn));
while ( $rowe = $rese->fetch_assoc() ) {
    $em1 = $rowe['email1'];
    $em2 = $rowe['email2'];
    $em3 = $rowe['email3'];
}

$sql = "SELECT * FROM chamado WHERE id = ".$cod;
$res = $conn->query( $sql );
while ( $row = $res->fetch_assoc() ) {
    $responsavel = $row['criado_por'];
    $responsaveltipo = $row['tipo'];
    $protocolo = $row['protocolo'];
}
    $sql0 = $conn->query("UPDATE chamado SET status = '6', fechado_por ='".$idusuario."' WHERE id = $cod");

                    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                    $enviaFormularioParaNome = 'Monsat';
                    $enviaFormularioParaEmail = $em1;
                    $caixaPostalServidorNome = 'Monsat';
                    $caixaPostalServidorEmail = 'agendamento@monsatbr.com.br';
                    $caixaPostalServidorSenha = 'monsat2030';
                    $assu = 'Chamado fechado - '.$protocolo;
                    /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                    $mensagemConcatenada = '<html><body>';
                    $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                      <tr>
                          <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                          <td valign='top' width='20'></td>
                          <td valign='top'>
                              <h3 style='font-family: Tahoma;'>MS HELP</h3>
                              <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                              Seu chamado número ".$protocolo." foi encerrado.<br>
                              <p style='color:#525252;font-size:12px;line-height:18px;font-family: Tahoma;'>* N&atilde;o responda a este e-mail. Esta mensagem &eacute; gerada automaticamente.</p>
                          </td>
                      </tr>
                    </table>";
                    $mensagemConcatenada .= "</body></html>";

                    require_once('PHPMailer-master/PHPMailerAutoload.php');
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth  = true;
                    $mail->Charset   = 'utf8_decode()';
                    $mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
                    $mail->Port  = '587';
                    $mail->Username  = $caixaPostalServidorEmail;
                    $mail->Password  = $caixaPostalServidorSenha;
                    $mail->From  = $caixaPostalServidorEmail;
                    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
                    $mail->IsHTML(true);
                    $mail->Subject  = utf8_decode($assu);
                    $mail->Body  = utf8_decode($mensagemConcatenada);
                    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

                    $sqlem = "SELECT DISTINCT email FROM chamado_resposta WHERE id_chamado = ".$cod;
                    $resem = $conn->query( $sqlem );
                    while ( $rowem = $resem->fetch_assoc() ) {
                        $emai = $rowem['email'];
                        $mail->AddCC($emai, 'Monsat');
                    }

                    //if(!$mail->Send()){} else{
                    if($mail->Send()){}

                  $url = "chamados.php";
                  echo "<script>alert('Chamado '.$protocolo.' fechado com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

php } ?>
