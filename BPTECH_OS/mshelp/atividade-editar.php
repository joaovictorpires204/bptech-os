<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Editar atividade
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">

        <?php
        $cod = $_GET['p'];
        $sql = "SELECT * FROM atividades WHERE id = ".$cod;
        $res = $conn->query( $sql ) or die ( mysqli_error($conn));
        while ( $row = $res->fetch_assoc() ) {
        ?>

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="setor">Setor</label>
                    <div class="col-md-9">
                        <select name="setor" class="form-control" id="cod_setor2">
                            <option value="0">Selecione</option>
                            <?php
                            $sql = "SELECT * FROM setores ORDER BY setor";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row2 = $res->fetch_assoc() ) {
                                if($row2['id'] === $row['setor']){ $selecionado = 'selected=""';} else { $selecionado = '';}
                                echo '<option value="'.$row2['id'].'" '.$selecionado.'>'.$row2['setor'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome</label>
                    <div class="col-md-9">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['atividade'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                        <select name="v2" class="form-control">
                            <option value="0" <?php if($row['ativo'] == '0'){ echo "selected";}?>>Não</option>
                            <option value="1" <?php if($row['ativo'] == '1'){ echo "selected";}?>>Sim</option>
                        </select>
                    </div>
                </div>



                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Editar">EDITAR</button>
                    </div>
                </div>

                <?php
                if(isset($_POST['enviar']) && $_POST['enviar'] == 'Editar'){
                    $nome = make_safe($_POST['nome']);
                    $setor = make_safe($_POST['setor']);
                    $ativo = make_safe($_POST['ativo']);

                    $sql1 = $conn->query("UPDATE `atividades` SET
                        `setor`='".$setor."',
                        `atividade`='".$nome."',
                        `ativo`='".$ativo."'
                         WHERE `id` = {$cod}") or die ( mysqli_error($conn));



                  $url = "atividades.php";
                  echo "<script>alert('Atividade editada com sucesso!'); </script>";
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
            <?php include "atividade-dados.php"; ?>
        </div>
    </div>
</div>

<?php } else { header("Location: inicial.php"); } ?>
<?php include "rodape.php"; ?>
