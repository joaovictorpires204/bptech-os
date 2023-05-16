<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Editar cliente
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">

        <?php
        $cod = $_GET['p'];
        $sql = "SELECT * FROM clientes WHERE id = ".$cod;
        $res = $conn->query( $sql ) or die ( mysqli_error($conn));
        while ( $row = $res->fetch_assoc() ) {
        ?>

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome</label>
                    <div class="col-md-8">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['cliente'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="email">E-mail</label>
                    <div class="col-md-8">
                        <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row['email1'];?>">
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
                    $email = make_safe($_POST['email']);
                    $login = make_safe($_POST['usuario']);
                    $senha = make_safe($_POST['senha']);

                         if($senha != ''){
                           $senha = sha1($senha);
                           $sql1 = $conn->query("UPDATE clientes SET
                           cliente = '".$nome."',
                           email1 = '".$email."',
                           usuario = '".$login."',
                           senha = '".$senha."'
                           WHERE id = $cod") or die ( mysqli_error($conn));
                         } else {
                           $sql1 = $conn->query("UPDATE clientes SET
                           cliente = '".$nome."',
                           email1 = '".$email."',
                           usuario = '".$login."'
                           WHERE id = $cod") or die ( mysqli_error($conn));
                         }

                  $url = "clientes.php";
                  echo "<script>alert('Cliente editado com sucesso!'); </script>";
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
            <?php include "cliente-dados.php"; ?>
        </div>
    </div>
</div>

<?php } else { header("Location: inicial.php"); } ?>
<?php include "rodape.php"; ?>
