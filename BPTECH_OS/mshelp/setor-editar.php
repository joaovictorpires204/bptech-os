<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1') { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Editar setor
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">

        <?php
        $cod = $_GET['p'];
        $sql = "SELECT * FROM setores WHERE id = ".$cod;
        $res = $conn->query( $sql ) or die ( mysqli_error($conn));
        while ( $row = $res->fetch_assoc() ) {
        ?>

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome</label>
                    <div class="col-md-9">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['setor'];?>">
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

                    $sql1 = $conn->query("UPDATE `setores` SET
                        `setor`='".$nome."'
                         WHERE `id` = {$cod}") or die ( mysqli_error($conn));

                  $url = "setores.php";
                  echo "<script>alert('Setor editado com sucesso!'); </script>";
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
            <?php include "setor-dados.php"; ?>
        </div>
    </div>
</div>

<?php } else { header("Location: inicial.php"); } ?>
<?php include "rodape.php"; ?>
