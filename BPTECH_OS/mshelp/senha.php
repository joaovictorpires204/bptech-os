<?php include "topo.php"; ?>

<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Alterar senha
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="senha">Nova Senha</label>
                    <div class="col-md-8">
                        <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md">
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label" for="enviar"></label>
                    <div class="col-md-4">
                        <button id="enviar" name="enviar" class="btn btn-primary" value="Editar">ALTERAR</button>
                    </div>
                </div>

                <?php
                if(isset($_POST['enviar']) && $_POST['enviar'] == 'Editar'){

                    $senha = make_safe($_POST['senha']);
                     $senha = sha1($senha);
                    $sql1 = $conn->query("UPDATE usuarios SET
                      senha = '".$senha."'
                      WHERE id = $idusuario") or die ( mysqli_error($conn));

                  $url = "inicial.php";
                  echo "<script>alert('Senha alterada com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>
</div>

<?php include "rodape.php"; ?>
