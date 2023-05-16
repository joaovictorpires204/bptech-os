<?php include "topo.php"; ?>

<?php
echo "<script>window.onload = function () {
    localStorage.setItem('justOnce', 'false')}</script>";
date_default_timezone_set('America/Sao_Paulo');
$sqle = "SELECT * FROM email WHERE id = '1'";
$rese = $conn->query( $sqle ) or die ( mysqli_error($conn));
while ( $rowe = $rese->fetch_assoc() ) {
    $em1 = $rowe['email1'];
    $em2 = $rowe['email2'];
    $em3 = $rowe['email3'];
}

$cod = $_GET['c'];
$sql = "SELECT * FROM chamado WHERE id = ".$cod;
$res = $conn->query( $sql );
while ( $row = $res->fetch_assoc() ) {
    $responsavel = $row['criado_por'];
    $responsaveltipo = $row['tipo'];
    $protocolo = $row['protocolo'];
    $setore = $row['setor'];
}

 if (($responsavel === $idusuario && $responsaveltipo != '1')  || $_SESSION['UserTipo'] === '1' ) { ?>




<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1></h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
        <form class="form-horizontal" method="post" action='chamado.php?c=<?php echo $cod; ?>' enctype="multipart/form-data">
            <fieldset>

                <?php
                
                $sql = "SELECT * FROM chamado WHERE id = ".$cod;
                $res = $conn->query( $sql ) or die ( mysqli_error($conn));
                while ( $row = $res->fetch_assoc() ) {
                ?>

            <div class="chamado">
                <h3><?php echo 'Título: '.$row['assunto'];?></h3>
                <h4><b>Chamado</b>: <?php if($row['tipo'] = '1'){ $destino = 'Interno';} else { $destino = 'Cliente';} ?> <?php echo $destino; ?></h4>
                <h4><b>Cliente</b>: <?php
                $sql10 = "SELECT * FROM clientes WHERE id = {$row['cliente']}";
                    $res10 = $conn->query( $sql10 )or die ( mysqli_error($conn));
                    while ( $row10 = $res10->fetch_assoc() ) {
                ?>
                <?php echo $row10['cliente']; ?>
                <?php } ?></h4>
                <h4><b>Status</b>: <?php if($row['status'] === '1'){ echo 'Novo';}
                    if($row['status'] === '2'){ echo 'Aberto';}
                    if($row['status'] === '3'){ echo 'Atrasado';}
                    if($row['status'] === '4'){ echo 'Fechado';}
                    if($row['status'] === '5'){ echo 'Aguardando Resposta';}
                    ?></h4>
                <h4><b>Data de abertura</b>: <?php echo date("d/m/Y H:i", strtotime( $row['data'])); ?></h4>
                <h4><b>Setor</b>: <?php
                    $sql02 = "SELECT * FROM setores WHERE id = {$row['setor']}";
                    $res02 = $conn->query( $sql02 )or die ( mysqli_error($conn));
                    while ( $row02 = $res02->fetch_assoc() ) {
                ?>
                    <?php echo $row02['setor']; ?>
                <?php } ?></h4>
                <h4><b>Atividade</b>: <?php
                    $sql02 = "SELECT * FROM atividades WHERE id = {$row['atividade']}";
                    $res02 = $conn->query( $sql02 )or die ( mysqli_error($conn));
                    while ( $row02 = $res02->fetch_assoc() ) {
                ?>
                    <?php echo $row02['atividade']; ?>
                <?php } ?></h4>

                <?php if($row['tipo'] = '1'){ ?>
                <h4><b>Solicitante</b>:
                <?php
                    $sql02 = "SELECT * FROM usuarios WHERE id = {$row['criado_por']}";
                    $res02 = $conn->query( $sql02 )or die ( mysqli_error($conn));
                    while ( $row02 = $res02->fetch_assoc() ) {
                         echo $row02['nome'];
                    }
                ?></h4>
                <?php } else if($row['tipo'] = '2'){ ?>
                    <h4><b>Solicitante</b>:
                    <?php
                        $sql02 = "SELECT * FROM clientes WHERE id = {$row['criado_por']}";
                        $res02 = $conn->query( $sql02 )or die ( mysqli_error($conn));
                        while ( $row02 = $res02->fetch_assoc() ) {
                             echo $row02['cliente'];
                        }
                    ?></h4>

                <?php } else if($row['tipo'] = '3'){ ?>
                    <h4><b>Solicitante</b>:
                    <?php
                        $sql02 = "SELECT * FROM fornecedores WHERE id = {$row['criado_por']}";
                        $res02 = $conn->query( $sql02 )or die ( mysqli_error($conn));
                        while ( $row02 = $res02->fetch_assoc() ) {
                             echo $row02['fornecedor'];
                        }
                    ?></h4>

                <?php } ?>

            </div>

                <input name="nome" type="hidden" value="<?php echo $nomeusuario; ?>">
                <input name="email" type="hidden" value="<?php echo $emailusuario; ?>">
                <input name="telefone" type="hidden">


            <?php if($row['status'] != '4' && $row['status'] != '6' ){ ?>
            <div class="chamado">
                <h3>Responder Chamado</h3>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="obs">Resposta</label>
                    <div class="col-md-9">
                        <textarea name="obs" class="form-control input-md"></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-9 control-label" for="enviar"></label>
                    <div class="col-md-2">
                        <button id="enviar" name="enviar" class="btn btn-lg btn-block btn-success" value="responder">RESPONDER</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-9 control-label" for="voltar"></label>
                    <div class="col-md-2">
                        <button id="voltar" name="voltar" class="btn btn-block btn-secondary" value="voltar">VOLTAR</button>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($row['status'] != '4' && $row['status'] != '6' && $tipoacesso === '1' ){ ?>
            <div class="chamado">
                <h3>Finalizar chamado</h3>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button  name="fechar" class="btn btn-lg btn-block btn-danger" value="fechar">FECHAR CHAMADO</button>
                    </div>
                </div>
            </div>
        <?php } else if($row['status'] != '4' && $row['status'] != '6' && $tipoacesso != '1' ){ ?>
            <div class="chamado">
                <h3>Cancelar chamado</h3>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button  name="fechar" class="btn btn-block btn-warning" value="cancelar">CANCELAR CHAMADO</button>
                    </div>
                </div>
            </div>

        <?php } else if($row['status'] === '4' || $row['status'] === '6' ){ ?>
            <div class="chamado">
                <h3>Reabrir chamado</h3>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button  name="fechar" class="btn btn-block btn-info" value="reabrir">REABRIR CHAMADO</button>
                    </div>
                </div>
            </div>

        <?php } ?>

            <?php
            $sqlc = "SELECT * FROM chamado_resposta WHERE id_chamado = {$cod} ORDER BY data DESC";
            $resc = $conn->query( $sqlc ) or die ( mysqli_error($conn));
            while ( $rowc = $resc->fetch_assoc() ) {
            ?>

            <div class="chamado">
                <h3><?php echo $rowc['nome']; ?> disse:</h3>
                <p><?php echo $rowc['dados']; ?></p>

                <h6><b>Data: </b><?php echo date("d/m/Y H:i", strtotime( $rowc['data'])); ?></h6>
                <h6><b>E-mail: </b><?php echo $rowc['email']; ?></h6>
                <h6><b>Telefone: </b><?php echo $rowc['telefone']; ?></h6>
            </div>

            <?php } ?>

            <div class="chamado">
                <h3>Arquivos</h3>
                <?php
                $sqla = "SELECT * FROM chamado_arquivo WHERE id_chamado = {$cod}";
                $resa = $conn->query( $sqla ) or die ( mysqli_error($conn));
                while ( $rowa = $resa->fetch_assoc() ) {
                ?>
                <a href="<?php echo $rowa['caminho']; ?><?php echo $rowa['arquivo']; ?>" download=""><?php echo $rowa['arquivo']; ?></a>

                <?php } ?>

            </div>



            
        

        <?php if($row['status'] != '4' && $row['status'] != '6' && $tipoacesso === '1' ){ ?>
        <div class="chamado">
            <h3>Transferir setor</h3>
            <div class="form-group">
                <label class="col-md-4 control-label" for="setor">Para qual setor deseja transferir esse chamado:</label>
                <div class="col-md-7">
                    <select name="setor1" class="form-control" id="cod_setor">
                        <option value="0">Selecione</option>
                        <?php
                        $sql = "SELECT * FROM setores WHERE id != {$setore} ORDER BY setor";
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
                    <select name="atividade1" class="form-control" id="cod_atividade">
                        <option value="0">Selecione</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="obs">Descrição</label>
                <div class="col-md-7">
                    <textarea name="obs1" class="form-control input-md"></textarea>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="form-group">
                <label class="col-md-9 control-label" for="enviar"></label>
                <div class="col-md-2">
                    <button name="adicionar" class="btn btn-primary" value="novosetor">TRANSFERIR SETOR</button>
                </div>
            </div>

        </div>
        <?php } ?>




                <div class="clearfix" style="padding-bottom:80px;"></div>


                <?php
                $sqlc = "SELECT email, nome FROM chamado_resposta WHERE id_chamado = {$cod} ORDER BY data ASC LIMIT 1";
                $resc = $conn->query( $sqlc ) or die ( mysqli_error($conn));
                while ( $rowc = $resc->fetch_assoc() ) {
                    $emailpara = $rowc['email'];
                    $nomepara = $rowc['nome'];
                }

                if(isset($_POST['voltar']) && $_POST['voltar'] === 'voltar'){
                    $url = "chamados.php";
                  echo "<script>location.href='".$url."'</script>";
                }

                if(isset($_POST['enviar']) && $_POST['enviar'] === 'responder'){

                    

                    $obs = make_safe($_POST['obs']);
                    $nome = make_safe($_POST['nome']);
                    $email = make_safe($_POST['email']);
                    $telefone = make_safe($_POST['telefone']);

                    $tipo = $tipoacesso;
                    if($tipoacesso === '1'){
                        $status = '5';
                    } else{
                        $status = '5';
                    }

                    $sql0 = $conn->query("UPDATE chamado SET
                    status = '".$status."'
                    WHERE id = $cod");

                    $sql2 = $conn->query("INSERT INTO chamado_resposta (`id_chamado`, `nome`, `email`, `telefone`, `dados`, `usuario`, `tipo`) VALUES ('".$cod."', '".$nome."', '".$email."', '".$telefone."', '".$obs."', '".$idusuario."','".$tipo."');") or die ( mysqli_error($conn));

                    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                    $enviaFormularioParaNome = 'Não Responda - Monsat';
                    $enviaFormularioParaEmail = $em1;
                    $caixaPostalServidorNome = 'Não Responda - Monsat';
                    $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                    $caixaPostalServidorSenha = 'M0ns@tNR2018';
                    $assu = 'Chamado respondido - '.$protocolo;
                    /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                    $mensagemConcatenada = '<html><body>';
                    $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                      <tr>
                          <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                          <td valign='top' width='20'></td>
                          <td valign='top'>
                              <h3 style='font-family: Tahoma;'>MS HELP</h3>
                              <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                              Seu chamado ".$protocolo." possui uma nova resposta.<br>
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
                    $mail->Host  = 'smtp.office365.com';
                    $mail->Port  = '587';
                    $mail->Username  = $caixaPostalServidorEmail;
                    $mail->Password  = $caixaPostalServidorSenha;
                    $mail->From  = $caixaPostalServidorEmail;
                    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
                    $mail->IsHTML(true);
                    $mail->Subject  = utf8_decode($assu);
                    $mail->Body  = utf8_decode($mensagemConcatenada);
                    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
                    $mail->AddAddress($emailpara,utf8_decode($nomepara));
                    $mail->AddCC($em2, 'Monsat');
                    $mail->AddCC($em3, 'Monsat');

                    $sqlem = "SELECT DISTINCT email FROM chamado_resposta WHERE id_chamado = ".$cod;
                    $resem = $conn->query( $sqlem );
                    while ( $rowem = $resem->fetch_assoc() ) {
                        $emai = $rowem['email'];
                        $mail->AddCC($emai, 'Monsat');
                    }

                    //if(!$mail->Send()){} else{
                    if($mail->Send()){}

                  $url = "chamados.php";
                //   echo "<script>alert('Resposta ao chamado '.$protocolo.' cadastrada com sucesso!'); </script>";
                //   echo "<script>location.href='".$url."'</script>";
                echo "<script>alert('Chamado '.$protocolo.' respondido com sucesso! Selecione uma ação para continuar.'); </script>";
             
                //  echo "<script>window.onload = function () {
                //     if (localStorage.justOnce==='false') {localStorage.setItem('justOnce', 'true');}}</script>";
                //     echo "<script>alert('Chamado '.$protocolo.' fechado com sucesso!'); </script>";
                //     echo "<script>location.href='".$url."'</script>";
                }
                ?>

                <?php
                if(isset($_POST['fechar']) && $_POST['fechar'] === 'fechar'){

                    $sql0 = $conn->query("UPDATE chamado SET
                    status = '4',
                    fechado_por ='".$idusuario."'
                    WHERE id = $cod");

                    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                    $enviaFormularioParaNome = 'Não Responda - Monsat';
                    $enviaFormularioParaEmail = $em1;
                    $caixaPostalServidorNome = 'Não Responda - Monsat';
                    $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                    $caixaPostalServidorSenha = 'M0ns@tNR2018';
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
                    $mail->Host  = 'smtp.office365.com';
                    $mail->Port  = '587';
                    $mail->Username  = $caixaPostalServidorEmail;
                    $mail->Password  = $caixaPostalServidorSenha;
                    $mail->From  = $caixaPostalServidorEmail;
                    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
                    $mail->IsHTML(true);
                    $mail->Subject  = utf8_decode($assu);
                    $mail->Body  = utf8_decode($mensagemConcatenada);
                    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
                    $mail->AddAddress($emailpara,utf8_decode($nomepara));
                    $mail->AddCC($em2, 'Monsat');
                    $mail->AddCC($em3, 'Monsat');

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

                <?php
                if(isset($_POST['fechar']) && $_POST['fechar'] === 'cancelar'){

                    $sql0 = $conn->query("UPDATE chamado SET
                    status = '6',
                    fechado_por ='".$idusuario."'
                    WHERE id = $cod");

                    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                    $enviaFormularioParaNome = 'Não Responda - Monsat';
                    $enviaFormularioParaEmail = $em1;
                    $caixaPostalServidorNome = 'Não Responda - Monsat';
                    $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                    $caixaPostalServidorSenha = 'M0ns@tNR2018';
                    $assu = 'Chamado Cancelado - '.$protocolo;
                    /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                    $mensagemConcatenada = '<html><body>';
                    $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                      <tr>
                          <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                          <td valign='top' width='20'></td>
                          <td valign='top'>
                              <h3 style='font-family: Tahoma;'>MS HELP</h3>
                              <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                              O chamado número ".$protocolo." foi cancelado pelo usuário.<br>
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
                    $mail->Host  = 'smtp.office365.com';
                    $mail->Port  = '587';
                    $mail->Username  = $caixaPostalServidorEmail;
                    $mail->Password  = $caixaPostalServidorSenha;
                    $mail->From  = $caixaPostalServidorEmail;
                    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
                    $mail->IsHTML(true);
                    $mail->Subject  = utf8_decode($assu);
                    $mail->Body  = utf8_decode($mensagemConcatenada);
                    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
                    $mail->AddAddress($emailpara,utf8_decode($nomepara));
                    $mail->AddCC($em2, 'Monsat');
                    $mail->AddCC($em3, 'Monsat');

                    $sqlem = "SELECT DISTINCT email FROM chamado_resposta WHERE id_chamado = ".$cod;
                    $resem = $conn->query( $sqlem );
                    while ( $rowem = $resem->fetch_assoc() ) {
                        $emai = $rowem['email'];
                        $mail->AddCC($emai, 'Monsat');
                    }

                    //if(!$mail->Send()){} else{
                    if($mail->Send()){}

                  $url = "chamados.php";
                  echo "<script>alert('Chamado '.$protocolo.' cancelado com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

                <?php
                if(isset($_POST['fechar']) && $_POST['fechar'] === 'reabrir'){

                    $sql0 = $conn->query("UPDATE chamado SET
                    status = '2',
                    fechado_por ='".$idusuario."'
                    WHERE id = $cod");

                    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                    $enviaFormularioParaNome = 'Não Responda - Monsat';
                    $enviaFormularioParaEmail = $em1;
                    $caixaPostalServidorNome = 'Não Responda - Monsat';
                    $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                    $caixaPostalServidorSenha = 'M0ns@tNR2018';
                    $assu = 'Chamado Reaberto - '.$protocolo;
                    /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                    $mensagemConcatenada = '<html><body>';
                    $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                      <tr>
                          <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                          <td valign='top' width='20'></td>
                          <td valign='top'>
                              <h3 style='font-family: Tahoma;'>MS HELP</h3>
                              <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                              O chamado número ".$protocolo." foi reaberto.<br>
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
                    $mail->Host  = 'smtp.office365.com';
                    $mail->Port  = '587';
                    $mail->Username  = $caixaPostalServidorEmail;
                    $mail->Password  = $caixaPostalServidorSenha;
                    $mail->From  = $caixaPostalServidorEmail;
                    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
                    $mail->IsHTML(true);
                    $mail->Subject  = utf8_decode($assu);
                    $mail->Body  = utf8_decode($mensagemConcatenada);
                    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
                    $mail->AddAddress($emailpara,utf8_decode($nomepara));
                    $mail->AddCC($em2, 'Monsat');
                    $mail->AddCC($em3, 'Monsat');

                    $sqlem = "SELECT DISTINCT email FROM chamado_resposta WHERE id_chamado = ".$cod;
                    $resem = $conn->query( $sqlem );
                    while ( $rowem = $resem->fetch_assoc() ) {
                        $emai = $rowem['email'];
                        $mail->AddCC($emai, 'Monsat');
                    }

                    //if(!$mail->Send()){} else{
                    if($mail->Send()){}

                  $url = "chamados.php";
                  echo "<script>alert('Chamado '.$protocolo.' reaberto com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

                <?php
                if(isset($_POST['adicionar']) && $_POST['adicionar'] == 'novosetor'){

                    $setor = make_safe($_POST['setor1']);
                    $ativ = make_safe($_POST['atividade1']);
                    $obs = make_safe($_POST['obs1']);
                    $nome = make_safe($_POST['nome']);
                    $email = make_safe($_POST['email']);
                    $telefone = make_safe($_POST['telefone']);

                    $sql0 = $conn->query("UPDATE chamado SET
                    setor = '".$setor."',
                    atividade = '".$ativ."'
                    WHERE id = $cod");

                    $sql2 = $conn->query("INSERT INTO chamado_resposta (`id_chamado`, `nome`, `email`, `telefone`, `dados`, `usuario`, `tipo`) VALUES ('".$cod."', '".$nome."', '".$email."', '".$telefone."', '".$obs."', '".$idusuario."','".$tipoacesso."');") or die ( mysqli_error($conn));


                            /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
                            $enviaFormularioParaNome = 'Não Responda - Monsat';
                            $enviaFormularioParaEmail = $em1;
                            $caixaPostalServidorNome = 'Não Responda - Monsat';
                            $caixaPostalServidorEmail = 'nao-responda@monsatbr.com.br';
                            $caixaPostalServidorSenha = 'M0ns@tNR2018';
                            $assu = 'Transferencia de setor para chamado - '.$protocolo;
                            /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

                            $mensagemConcatenada = '<html><body>';
                            $mensagemConcatenada .="<table border='0' cellpadind='0' cellspacing='0'>
                              <tr>
                                  <td valign='top' width='100'><img src='http://www.monsatbr.com.br/mshelp/images/logo.png'></td>
                                  <td valign='top' width='20'></td>
                                  <td valign='top'>
                                      <h3 style='font-family: Tahoma;'>MS HELP</h3>
                                      <p style='color:#525252;font-size:12px;line-height:18px;font-family:Tahoma;'>
                                      Seu chamado ".$protocolo." foi transferido de setor. Por favor, aguarde novas interações.<br>
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
                            $mail->Host  = 'smtp.office365.com';
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
                  echo "<script>alert('Chamado '.$protocolo.' transferido com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

                <?php } ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
<?php } ?>
<?php include "rodape.php"; ?>
