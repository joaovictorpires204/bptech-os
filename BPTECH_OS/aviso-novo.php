<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1') { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Adicionar Aviso
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Título</label>
                    <div class="col-md-9">
                        <input name="titulo" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Aviso</label>
                    <div class="col-md-9">
                        <textarea name="descricao" class="form-control input-md" required=""></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Início</label>
                    <div class="col-md-3">
                        <input name="inicio" type="text" placeholder="" class="form-control input-md datepicker" required="">
                    </div>
                    <label class="col-md-1 control-label" for="nome">Fim</label>
                    <div class="col-md-3">
                        <input name="fim" type="text" placeholder="" class="form-control input-md datepicker" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="setor">Aplicavel a:</label>
                    <div class="clearfix"></div>
                    <label class="col-md-3 control-label" for="setor">CLIENTES</label>
                    <div class="col-md-8">
                        <?php
                        $sql3 = "SELECT * FROM clientes ORDER BY cliente";
                            $res3 = $conn->query( $sql3 )or die ( mysqli_error($conn));
                            while ( $row3 = $res3->fetch_assoc() ) {
                        ?>
                            <div class="col-sm-2 col-md-3 col-xs-12">
                                <label class="checkbox-inline" for="para-c<?php echo $row3['id']; ?>">
                                    <input type="checkbox" name="parac[]" id="para-c<?php echo $row3['id']; ?>" value="<?php echo $row3['id']; ?>"><?php echo $row3['cliente'];?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <label class="col-md-3 control-label" for="setor">FORNECEDORES</label>
                    <div class="col-md-8">
                        <?php
                        $sql3 = "SELECT * FROM fornecedores ORDER BY fornecedor";
                            $res3 = $conn->query( $sql3 )or die ( mysqli_error($conn));
                            while ( $row3 = $res3->fetch_assoc() ) {
                        ?>
                            <div class="col-sm-2 col-md-3 col-xs-12">
                                <label class="checkbox-inline" for="paraf-<?php echo $row3['id']; ?>">
                                    <input type="checkbox" name="paraf[]" id="paraf-<?php echo $row3['id']; ?>" value="<?php echo $row3['id']; ?>"><?php echo $row3['fornecedor'];?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                        <div class="clearfix"></div>
                            <label class="col-md-3 control-label" for="setor">COLABORADORES</label>
                            <div class="col-md-8">
                                <?php
                                $sql3 = "SELECT * FROM usuarios ORDER BY nome";
                                    $res3 = $conn->query( $sql3 )or die ( mysqli_error($conn));
                                    while ( $row3 = $res3->fetch_assoc() ) {
                                ?>
                                    <div class="col-sm-2 col-md-3 col-xs-12">
                                        <label class="checkbox-inline" for="parau-<?php echo $row3['id']; ?>">
                                            <input type="checkbox" name="parau[]" id="parau-<?php echo $row3['id']; ?>" value="<?php echo $row3['id']; ?>"><?php echo $row3['nome'];?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Adicionar">CADASTRAR</button>
                    </div>
                </div>



                <?php
                if(isset($_POST['enviar']) && $_POST['enviar'] == 'Adicionar'){

                    $titulo = make_safe($_POST['titulo']);
                    $inicio = make_safe($_POST['inicio']);
                    $fim = make_safe($_POST['fim']);
                    $descricao = make_safe($_POST['descricao']);
                    $descricao = nl2br($descricao);

                    $sql1 = $conn->query("INSERT INTO `avisos`(`titulo`, `texto`, `inicio`, `fim`) VALUES ('".$titulo."','".$descricao."','".$inicio."','".$fim."');") or die ( mysqli_error($conn));
                    $cod = $conn->insert_id;

                    for($i = 0; $i < count($_POST['parac']); $i++) {
                       if($_POST['parac'][$i] == 0 ){} else{
                       $sql2 = $conn->query("INSERT INTO usuario_aviso (user, aviso, tipo) VALUES ('".$_POST['parac'][$i]."','".$cod."','2');");
                       }
                    }
                    for($i = 0; $i < count($_POST['paraf']); $i++) {
                       if($_POST['paraf'][$i] == 0 ){} else{
                       $sql2 = $conn->query("INSERT INTO usuario_aviso (user, aviso, tipo) VALUES ('".$_POST['paraf'][$i]."','".$cod."','3');");
                       }
                    }
                    for($i = 0; $i < count($_POST['parau']); $i++) {
                       if($_POST['parau'][$i] == 0 ){} else{
                       $sql2 = $conn->query("INSERT INTO usuario_aviso (user, aviso, tipo) VALUES ('".$_POST['parau'][$i]."','".$cod."','1');");
                       }
                    }



                  $url = "inicial.php";
                  echo "<script>alert('Aviso criado!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>
</div>

<?php } else {header("Location: inicial.php");} ?>

<?php include "rodape.php"; ?>
