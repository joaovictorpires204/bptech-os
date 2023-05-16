<?php include "topo.php"; ?>

<div class="container">

    <?php
    $hoje = date('Y-m-d');
    $sql = "SELECT DISTINCT * FROM avisos INNER JOIN usuario_aviso ON inicio <= '$hoje' AND fim >= '$hoje' AND ($tipoacesso = usuario_aviso.tipo) AND ($idusuario = usuario_aviso.user)";
    $res = $conn->query( $sql )or die ( mysqli_error($conn));
    while ( $row = $res->fetch_assoc() ) {
    ?>
    <div class="col-lg-6 btnhome btnaviso">
        <a>
            <h1><?php echo $row['titulo']?></h1>
            <p><?php echo  $row['texto']?></p>
        </a>
    </div>
    <?php } ?>





    <div class="clearfix"></div>

        <div class="col-lg-4 btnhome">
            <a href="chamado-novo.php">
                <h1>Abrir chamado</h1>
                <p>Clique para abrir um novo chamado.</p>
            </a>
        </div>
        <div class="col-lg-4 btnhome">
            <a href="chamados.php">
                <h1>Gestão de Chamados</h1>
                <p>Gestão de chamados abertos.</p>
            </a>
        </div>


    <div class="clearfix"></div>
</div>

<?php include "rodape.php"; ?>
