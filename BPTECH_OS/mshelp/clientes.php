<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Clientes
        </h1>

        <!--a href="cliente-novo.php" class="novobtn">Adicionar Cliente</a-->

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
