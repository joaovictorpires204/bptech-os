<?php include "topo.php"; ?>

<?php


$p = (isset($_GET['p']))? $_GET['p'] : '';
$r = (isset($_GET['r']))? $_GET['r'] : '0';
$d = isset($_GET['d']) ? $_GET['d'] : '0';
$d2 = isset($_GET['d2']) ? $_GET['d2'] : '0';

//$mesinicio = $anoatual.'-'.$mesatual.'-01 00:00:00';
//$mesfim = $anoatual.'-'.$mesatual.'-31 23:59:59';
?>

<div class="container">
    <div class="col-lg-12 text-center titulo">
        <h1>
            MEUS CHAMADOS
        </h1>
    </div>

    <div class="col-lg-12">
        <div class="chamado">

            <h3>FILTRAR POR:</h3>
            <form>

                <div class="form-group">
                    <div class="col-md-3">
                        Número <input name="p" type="text" placeholder="" class="form-control input-md"  value="<?php echo $p; ?>">
                    </div>

                    <div class="col-sm-3">
                        Situação <select name="r" required=true class="fieldform form-control">
                            <option value='0'>TODOS</option>
                            <option value='2' <?php if($r === '2'){ echo 'selected';} ?>>Aberto</option>
                            <option value='3' <?php if($r === '3'){ echo 'selected';} ?>>Atrasado</option>
                            <option value='4' <?php if($r === '4'){ echo 'selected';} ?>>Fechado</option>
                            <option value='5' <?php if($r === '5'){ echo 'selected';} ?>>Em análise</option>
                            <option value='6' <?php if($r === '6'){ echo 'selected';} ?>>Cancelado</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                    Período:
                    <input name="d" type="text" class="form-control input-md datepicker" value="<?php echo $d;?>">
                    </div>
                    <div class="col-sm-2">
                    Até:
                    <input name="d2" type="text" class="form-control input-md datepicker" value="<?php echo $d2;?>">
                    </div>


                    <div class="col-md-2">
                        <br>
                        <button id="enviar" class="btn btn-primary">FILTRAR</button>
                    </div>
                </form>

                    <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-sm-12">
        <div class="ftabela mt40px">
            <div class="ftabela mt40px">
                <div class="ftabela-content">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>PROTOCOLO</th>
                                <th>ASSUNTO</th>
                                <th>DATA</th>
                                <th>ORIGEM</th>
                                <th>CLIENTE</th>
                                <th>SITUAÇÃO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if($d != '0'){
                                $d = $d . ' 00:00:00';
                                $d2 = $d2 . ' 23:59:59';

                                $sql0 = "SELECT DISTINCT chamado.* FROM chamado INNER JOIN usuario_setor ON
                                ($idusuario = criado_por) AND (status = {$r} OR {$r} = 0)  AND
                                (protocolo LIKE '%{$p}%') AND
                                (data >= '{$d}' AND data <= '{$d2}') AND ($tipoacesso = tipo)
                                ORDER BY data DESC";
                            } else {
                                $sql0 = "SELECT DISTINCT chamado.* FROM chamado INNER JOIN usuario_setor ON
                                ($idusuario = criado_por) AND
                                (status = {$r} OR {$r} = 0) AND ($tipoacesso = tipo) AND
                                (protocolo LIKE '%{$p}%')
                                ORDER BY data DESC";
                            }




                                $res0 = $conn->query( $sql0 )or die ( mysqli_error($conn));
                                while ( $row0 = $res0->fetch_assoc() ) {
                                ?>
                                    <tr>
                                        <td><?php echo $row0['protocolo']; ?></td>
                                        <td><?php echo $row0['assunto']; ?></td>
                                        <td><?php echo date("d/m/Y H:i", strtotime( $row0['data'])); ?></td>
                                        <?php
                                        if($tipo = '1'){ $destino = 'Interno';} else { $destino = 'Cliente';}  ?>
                                        <td><?php echo $destino; ?></td>



                                        <td><?php
                                        $sql11 = "SELECT * FROM clientes WHERE id = {$row0['cliente']}";
                                            $res11 = $conn->query( $sql11 )or die ( mysqli_error($conn));
                                            while ( $row11 = $res11->fetch_assoc() ) {
                                        ?>
                                        <?php echo $row11['cliente']; ?>
                                        <?php } ?>
                                        </td>

                                        <td><?php
                                            if($row0['status'] === '2'){ echo '<span class="sta3">Aberto</span>';}
                                            if($row0['status'] === '3'){ echo '<span class="sta6">Atrasado</span>';}
                                            if($row0['status'] === '4'){ echo '<span class="sta4">Fechado</span>';}
                                            if($row0['status'] === '5'){ echo '<span class="sta2">Em análise</span>';}
                                            if($row0['status'] === '6'){ echo '<span class="sta6">Cancelado</span>';}
                                            ?></td>



                                        <td>

                                            <ul class="btnaction">
                                                <?php if($row0['status'] != '4' && $row0['status'] != '6'){ ?>
                                                <li data-toggle="tooltip" title="Responder">
                                                    <a href="chamado.php?c=<?php echo $row0['id']; ?>">
                                                        <i class="fa fa-send-o" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>

                                                <?php if($row0['status'] != '4' && $row0['status'] != '6' && $tipoacesso === '1'){ ?>
                                                <li data-toggle="tooltip" title="Cancelar chamado">
                                                    <a href="fechar.php?c=<?php echo $row0['id']; ?>&u=<?php echo $idusuario;?>">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>

                                                <?php if($row0['status'] === '4' || $row0['status'] === '6'){ ?>
                                                <li data-toggle="tooltip" title="Ver Chamado">
                                                    <a href="chamado.php?c=<?php echo $row0['id']; ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <?php } ?>

                                            </ul>

                                        </td>
                                    </tr>
                                    <?php } ?>

                            </tbody>

                    </table>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<?php include "rodape.php"; ?>
