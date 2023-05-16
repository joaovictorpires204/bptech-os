<?php include "topo.php"; ?>

<?php
if ($tipoacesso === '1'){
    $tit1 = 'CHAMADO INTERNO';
} else {
    $tit1 = 'CHAMADO MS HELP';
}
?>

<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            <?php echo $tit1; ?>
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>


            <div class="chamado">
                <h3>Solicitação</h3>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="setor">Para qual setor deseja abrir seu chamado:</label>
                    <div class="col-md-7">
                        <select name="setor" class="form-control" id="cod_setor">
                            <option value="0">Selecione</option>
                            <?php
                            $sql = "SELECT * FROM setores ORDER BY setor";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row2 = $res->fetch_assoc() ) {
                                echo '<option value="'.$row2['id'].'">'.$row2['setor'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="cliente">Qual assunto deseja tratar em seu chamado:</label>
                    <div class="col-md-7">
                        <select name="atividade" class="form-control" id="cod_atividade">
                            <option value="0">Selecione</option>
                            <?php
                            $sql = "SELECT * FROM atividades ORDER BY atividade";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row2 = $res->fetch_assoc() ) {
                                echo '<option value="'.$row2['id'].'">'.$row2['atividade'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="chamado">
                <h3>Chamado</h3>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">Assunto</label>
                    <div class="col-md-9">
                        <input name="assunto" type="text" placeholder="" class="form-control input-md">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="obs">Descrição</label>
                    <div class="col-md-9">
                        <textarea name="obs" class="form-control input-md"></textarea>
                    </div>
                </div>
            </div>

            <div class="chamado">
                <h3>Adicionar arquivos</h3>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="obs">Arquivo</label>
                    <div class="col-md-9">
                        <input type="file" name="file1" class="fieldform">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="obs">Arquivo</label>
                    <div class="col-md-9">
                        <input type="file" name="file2" class="fieldform">
                    </div>
                </div>

            </div>

            <div class="chamado">
                <h3>Informações</h3>

            <?php if ($tipoacesso === '1'){ ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">Nome</label>
                    <div class="col-md-9">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" value="<?php echo $nomeusuario; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">E-mail</label>
                    <div class="col-md-9">
                        <input name="email" type="text" placeholder="" class="form-control input-md" value="<?php echo $emailusuario; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9">
                        <input name="telefone" type="hidden" placeholder="" class="form-control input-md">
                    </div>
                </div>


            <?php } else { ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">Nome</label>
                    <div class="col-md-9">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" value="<?php echo $nomeusuario; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">E-mail</label>
                    <div class="col-md-9">
                        <input name="email" type="text" placeholder="" class="form-control input-md" value="<?php echo $emailusuario; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="placa">Telefone</label>
                    <div class="col-md-9">
                        <input name="telefone" type="text" placeholder="" class="form-control input-md">
                    </div>
                </div>
            <?php } ?>

            </div>


                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-10 control-label" for="enviar"></label>
                    <div class="col-md-2">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Adicionar">ABRIR CHAMADO</button>
                    </div>
                </div>

                <div class="clearfix" style="padding-bottom:80px;"></div>





                <?php
                if(isset($_POST['enviar']) && $_POST['enviar'] == 'Adicionar'){

                    $setor = strtoupper($setor);
                    $setor = make_safe($_POST['setor']);
                    
                    $ativ = strtoupper($ativ);
                    $ativ = make_safe($_POST['atividade']);
                    
                    $assunto = strtoupper($assunto);
                    $assunto = make_safe($_POST['assunto']);
                    
                    $obs = strtoupper($obs);
                    $obs = make_safe($_POST['obs']);
                    
                    $nome = strtoupper($nome);
                    $nome = make_safe($_POST['nome']);

                    $email = strtoupper($email);
                    $email = make_safe($_POST['email']);
                    

                    $telefone = make_safe($_POST['telefone']);

                    $tipo = $tipoacesso;
                    if($tipoacesso === '1'){
                        $cliente = '0';
                    } else {
                        $cliente = $idusuario;
                    }

                    date_default_timezone_set('America/Sao_Paulo');
                    $mydate=getdate(date("U"));
                    $dia = $mydate[mday];
                    $mes = $mydate[mon];
                    $ano = $mydate[year];

                    $sql1 = $conn->query("INSERT INTO chamado (`setor`, `atividade`, `assunto`, `criado_por`, `cliente`, `tipo`, `status`) VALUES ('".$setor."', '".$ativ."', '".$assunto."', '".$idusuario."', '".$cliente."', '".$tipo."', '2');");
                    $cod = $conn->insert_id;

                    $protocolo = $ano.$mes.$dia.$cod;

                    $sql0 = $conn->query("UPDATE chamado SET
                    protocolo = '".$protocolo."'
                    WHERE id = $cod");

                    $sql2 = $conn->query("INSERT INTO chamado_resposta (`id_chamado`, `nome`, `email`, `telefone`, `dados`, `usuario`, `tipo`) VALUES ('".$cod."', '".$nome."', '".$email."', '".$telefone."', '".$obs."', '".$idusuario."','".$tipo."');") or die ( mysqli_error($conn));


                    // file 1
                		$fileName = $_FILES['file1']['name'];
                        $fileName = preg_replace("/[^a-zA-Z0-9.]/", "", $fileName); // remover acentos
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        // Settings
                        $targetDir = 'arquivos/'.$ano.'/'.$mes.'/';
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        // Create target dir
                        if (!file_exists($targetDir)) {
                        	@mkdir($targetDir);
                        }
                        $filePath = $targetDir . $fileName;
                        if(move_uploaded_file ($_FILES['file1']['tmp_name'],$filePath)){
                			chmod("$filePath",0777);
                			$nome_img = $fileName;

                            $sql3 = $conn->query("INSERT INTO chamado_arquivo (`id_chamado`, `caminho`, `arquivo`) VALUES ('".$cod."', '".$targetDir."', '".$nome_img."');");

                		}else{
                			$nome_img = '';
                		}

                        // file 2
                    		$fileName = $_FILES['file2']['name'];
                            $fileName = preg_replace("/[^a-zA-Z0-9.]/", "", $fileName); // remover acentos
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            // Settings
                            $targetDir = 'arquivos/'.$ano.'/'.$mes.'/';
                            if (!file_exists($targetDir)) {
                                mkdir($targetDir, 0777, true);
                            }
                            // Create target dir
                            if (!file_exists($targetDir)) {
                            	@mkdir($targetDir);
                            }
                            $filePath = $targetDir . $fileName;
                            if(move_uploaded_file ($_FILES['file2']['tmp_name'],$filePath)){
                    			chmod("$filePath",0777);
                    			$nome_img = $fileName;

                                $sql3 = $conn->query("INSERT INTO chamado_arquivo (`id_chamado`, `caminho`, `arquivo`) VALUES ('".$cod."', '".$targetDir."', '".$nome_img."');");

                    		}else{
                    			$nome_img = '';
                    		}


                            $sqle = "SELECT * FROM email WHERE id = '1'";
                            $rese = $conn->query( $sqle ) or die ( mysqli_error($conn));
                            while ( $rowe = $rese->fetch_assoc() ) {
                                $em1 = $rowe['email1'];
                                $em2 = $rowe['email2'];
                                $em3 = $rowe['email3'];
                            }




                            /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                            $enviaFormularioParaNome = 'Não responda - Monsat';
                            $enviaFormularioParaEmail = $em1;
                            $caixaPostalServidorNome = 'Não responda - Monsat';
                            $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                            $caixaPostalServidorSenha = 'TnDg9<@9933MvB{B/';
                            $assu = 'Novo chamado aberto - '.$protocolo;
                            /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                            $mensagemConcatenada = '<html><body>';
                            $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                              <tr>
                                  <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                                  <td valign='top' width='20'></td>
                                  <td valign='top'>
                                      <h3 style='font-family: Tahoma;'>MS HELP</h3>
                                      <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                                      Um novo chamado foi aberto.<br>
                                      <p style='color:#525252;font-size:12px;line-height:18px;font-family: Tahoma;'><a href='http://www.monsatbr.com.br/mshelp'>Clique aqui</a> para ler o chamado.</p>
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
                            $mail->AddCC($em2, 'Monsat');
                            $mail->AddCC($em3, 'Monsat');

                            $sqlem = "SELECT DISTINCT email FROM usuarios INNER JOIN usuario_setor ON usuario_setor.setor = {$setor} AND usuario_setor.usuario = usuarios.id";
                            $resem = $conn->query( $sqlem );
                            while ( $rowem = $resem->fetch_assoc() ) {
                                $emai = $rowem['email'];
                                $mail->AddCC($emai, 'Monsat');
                            }

                            //if(!$mail->Send()){} else{
                            if($mail->Send()){}

                  $url = "chamados.php";
                  echo "<script>alert('Chamado '.$protocolo.' aberto com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>
</div>

<?php include "rodape.php"; ?>
