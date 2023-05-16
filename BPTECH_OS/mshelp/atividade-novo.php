<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Cadastro de nova atividade
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
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
                                echo '<option value="'.$row2['id'].'">'.$row2['setor'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome da nova atividade</label>
                    <div class="col-md-9">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="ativo">Status</label>
                    <div class="col-md-9">
                        <select name="ativo" class="form-control">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
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

                    $nome = make_safe($_POST['nome']);
                    $setor = make_safe($_POST['setor']);
                    $ativo = make_safe($_POST['ativo']);

                    $sql1 = $conn->query("INSERT INTO `atividades`(`setor`, `atividade`, `ativo`, `cadastrado_por`) VALUES ('".$setor."','".$nome."','".$ativo."','".$idusuario."');") or die ( mysqli_error($conn));
                    $cod = $conn->insert_id;

                  $url = "atividades.php";
                  echo "<script>alert('Atividade criada com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12">
        <div class="ftabela mt40px">
            <?php include "atividade-dados.php"; ?>
        </div>
    </div>

</div>

<?php } else {header("Location: inicial.php");} ?>

<?php include "rodape.php"; ?>
