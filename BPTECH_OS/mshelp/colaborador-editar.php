<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Editar colaborador
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">

        <?php
        $cod = $_GET['p'];
        $sql = "SELECT * FROM usuarios WHERE id = ".$cod;
        $res = $conn->query( $sql ) or die ( mysqli_error($conn));
        while ( $row = $res->fetch_assoc() ) {
        ?>

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nivel">Nível</label>
                    <div class="col-md-8">
                        <select name="nivel" class="form-control">
                            <option value="5" <?php if($row['nivel'] == '5'){ echo "selected";}?>>Colaborador</option>
                            <option value="4" <?php if($row['nivel'] == '4'){ echo "selected";}?>>Supervisor</option>
                            <option value="3" <?php if($row['nivel'] == '3'){ echo "selected";}?>>Analista</option>
                            <option value="2" <?php if($row['nivel'] == '2'){ echo "selected";}?>>Coordenador</option>
                            <option value="1" <?php if($row['nivel'] == '1'){ echo "selected";}?>>Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="ativo">Está ativo?</label>
                    <div class="col-md-8">
                        <select name="ativo" class="form-control">
                            <option value="0" <?php if($row['ativo'] == '0'){ echo "selected";}?>>Não</option>
                            <option value="1" <?php if($row['ativo'] == '1'){ echo "selected";}?>>Sim</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome</label>
                    <div class="col-md-8">
                        <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['nome'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="email">E-mail</label>
                    <div class="col-md-8">
                        <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['email'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="usuario">Usuário</label>
                    <div class="col-md-8">
                        <input id="usuario" name="usuario" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['usuario'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="senha">Senha</label>
                    <div class="col-md-8">
                        <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Horário de acesso ao sistema</label>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="senha">Horário de Acesso</label>
                    <div class="col-md-3">
                    <input name='d3' class='form-control' value="<?php echo $row['seg1']; ?>">
                    
                    </input>
                    </div>
                    <div class="col-md-3">
                    <input name='d4' class='form-control' value="<?php echo $row['seg2']; ?>">
                    
                    </input>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="setor">Setor</label>
                    <div class="col-md-8">
                        <?php
                        $sql3 = "SELECT * FROM setores ORDER BY setor";
                            $res3 = $conn->query( $sql3 )or die ( mysqli_error($conn));
                            while ( $row3 = $res3->fetch_assoc() ) {

                                $sql_r = $conn->query("SELECT * FROM usuario_setor WHERE usuario = {$cod} AND setor = {$row3['id']}");
                                $total3 = $sql_r->num_rows;
                                if($total3 > 0){$checado = 'checked';} else {$checado = '';}
                        ?>
                            <div class="col-sm-2 col-md-3 col-xs-12">
                                <label class="checkbox-inline" for="para-<?php echo $row3['id']; ?>">
                                    <input type="checkbox" name="para[]" id="para-<?php echo $row3['id']; ?>" value="<?php echo $row3['id']; ?>" <?php echo $checado; ?>><?php echo $row3['setor'];?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="clearfix mb30px"></div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="enviar"></label>
                    <div class="col-md-6">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Editar">SALVAR</button>
                    </div>
                    <div class="col-md-4">
                        <button id="voltar" name="voltar" class="btn btn-secondary" value="Voltar">VOLTAR</button>
                    </div>
                </div>

                <?php
                if(isset($_POST['enviar']) && $_POST['enviar'] == 'Editar'){
                    $nivel = make_safe($_POST['nivel']);
                    $ativo = make_safe($_POST['ativo']);
                    $nome = make_safe($_POST['nome']);
                    $email = make_safe($_POST['email']);
                    $login = make_safe($_POST['usuario']);
                    $senha = make_safe($_POST['senha']);
                    $inicio = make_safe($_POST['inicio']);
                    $fim = make_safe($_POST['fim']);

                    // $d1 = make_safe($_POST['d1']);
                    // $d2 = make_safe($_POST['d2']);
                    $d1 = make_safe($_POST['d3']);
                    $d2 = make_safe($_POST['d4']);

                    if($senha != ''){
                      $senha = sha1($senha);
                      $sql1 = $conn->query("UPDATE usuarios SET
                      nivel = $nivel,
                      ativo = $ativo,
                      nome = '".$nome."',
                      email = '".$email."',
                      usuario = '".$login."',
                      senha = '".$senha."',
                      seg1 =  '".$d1."',
                      seg2 =  '".$d2."',
                      ter1 =  '".$d1."',
                      ter2 =  '".$d2."',
                      qua1 =  '".$d1."',
                      qua2 =  '".$d2."',
                      qui1 =  '".$d1."',
                      qui2 =  '".$d2."',
                      sex1 =  '".$d1."',
                      sex2 =  '".$d2."',
                      sab1 =  '".$d1."',
                      sab2 =  '".$d2."',
                      dom1 =  '".$d1."',
                      dom2 =  '".$d2."'
                      WHERE id = $cod") or die ( mysqli_error($conn));
                    } else {
                      $sql1 = $conn->query("UPDATE usuarios SET
                      nivel = $nivel,
                      ativo = $ativo,
                      nome = '".$nome."',
                      email = '".$email."',
                      usuario = '".$login."',
                      seg1 =  '".$d1."',
                      seg2 =  '".$d2."',
                      ter1 =  '".$d1."',
                      ter2 =  '".$d2."',
                      qua1 =  '".$d1."',
                      qua2 =  '".$d2."',
                      qui1 =  '".$d1."',
                      qui2 =  '".$d2."',
                      sex1 =  '".$d1."',
                      sex2 =  '".$d2."',
                      sab1 =  '".$d1."',
                      sab2 =  '".$d2."',
                      dom1 =  '".$d1."',
                      dom2 =  '".$d2."'
                      WHERE id = $cod") or die ( mysqli_error($conn));
                    }

                    $rem3 = $conn->query("DELETE FROM usuario_setor WHERE usuario = ".$cod);
                    for($i = 0; $i < count($_POST['para']); $i++) {
                       if($_POST['para'][$i] == 0 ){} else{
                       $sql2 = $conn->query("INSERT INTO usuario_setor (usuario, setor) VALUES ('".$cod."','".$_POST['para'][$i]."');");
                       }
                    }


        

                  $url = "colaboradores.php";
                  echo "<script>alert('Colaborador editado com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }else if(isset($_POST['voltar']) && $_POST['voltar'] == 'Voltar'){
                    $url = "colaboradores.php";
                    echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
        <?php } ?>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12">
        <div class="ftabela mt40px">
            <?php include "colaborador-dados.php"; ?>
        </div>
    </div>
</div>

<?php } else { header("Location: inicial.php"); } ?>
<?php include "rodape.php"; ?>
