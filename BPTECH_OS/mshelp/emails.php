<?php include "topo.php"; ?>

<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>

<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            E-mails
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
        <?php
        $sql = "SELECT * FROM email WHERE id = '1'";
        $res = $conn->query( $sql ) or die ( mysqli_error($conn));
        while ( $row = $res->fetch_assoc() ) {
        ?>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">E-mail</label>
                    <div class="col-md-8">
                        <input name="email1" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo $row['email1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">E-mail</label>
                    <div class="col-md-8">
                        <input name="email2" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo $row['email2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">E-mail</label>
                    <div class="col-md-8">
                        <input name="email3" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo $row['email3']; ?>">
                    </div>
                </div>

                <div class="clearfix mb30px"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Editar">Editar</button>
                    </div>
                </div>

        <?php
        if(isset($_POST['enviar']) && $_POST['enviar'] == 'Editar'){

            $email1 = make_safe($_POST['email1']);
            $email2 = make_safe($_POST['email2']);
            $email3 = make_safe($_POST['email3']);

            $sql1 = $conn->query("UPDATE `email` SET
                `email1`='".$email1."',
                `email2`='".$email2."',
                `email3`='".$email3."'
                WHERE id = 1") or die ( mysqli_error($conn));


          $url = "emails.php";
          echo "<script>alert('Destinatários de e-mail alterado!'); </script>";
          echo "<script>location.href='".$url."'</script>";
        }
        ?>

        </fieldset>
        </form>
        <?php } ?>
    </div>




</div>

<?php } else {header("Location: inicial.php");} ?>

<?php include "rodape.php"; ?>
