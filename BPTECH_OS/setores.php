<?php include "topo.php"; ?>
<?php if ($_SESSION['UserNivel'] <= $nivel_necessario || $_SESSION['UserTipo'] === '1' ) { ?>


<div class="">
    <div class="col-lg-12 text-center titulo">
        <h1>
            Projetos
        </h1>

        <!--a href="setor-novo.php" class="novobtn">Adicionar Setor</a-->

    </div>
    <div class="clearfix"></div>

    <div class="col-sm-12">
        <div class="ftabela mt40px">
            <?php include "setor-dados.php"; ?>
        </div>
    </div>
</div>

<?php } else {header("Location: inicial.php");} ?>

<?php include "rodape.php"; ?>
