<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Cadastro de novo cliente
        </h1>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12 formulario">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome">Nome do cliente</label>
                    <div class="col-md-8">
                        <input name="nome" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="email">E-mail</label>
                    <div class="col-md-8">
                        <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="usuario">Usuário</label>
                    <div class="col-md-8">
                        <input id="usuario" name="usuario" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="senha">Senha</label>
                    <div class="col-md-8">
                        <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">
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
                    $email = make_safe($_POST['email']);
                    $login = make_safe($_POST['usuario']);
                    $senha = make_safe($_POST['senha']);
                    $senha = sha1($senha);

                    $sql1 = $conn->query("INSERT INTO `clientes`(`cliente`, `email1`, `usuario`, `senha`, `cadastrado_por`) VALUES ('".$nome."','".$email."','".$login."','".$senha."','".$idusuario."');") or die ( mysqli_error($conn));

                  $url = "clientes.php";
                  echo "<script>alert('Cliente cadastrado com sucesso!'); </script>";
                  echo "<script>location.href='".$url."'</script>";
                }
                ?>

            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12">
        <div class="ftabela mt40px">
            <?php include "cliente-dados.php"; ?>
        </div>
    </div>






</div>

<?php } else {header("Location: inicial.php");} ?>

<?php include "rodape.php"; ?>
