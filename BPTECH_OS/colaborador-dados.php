        <div class="ftabela mt40px">
            <div class="ftabela-content">

                <table class="table">
                    <thead>
                        <tr>
                            <th>NOME</th>
                            <th>SETOR</th>
                            <th>PERFIL</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM usuarios ORDER BY nome";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row = $res->fetch_assoc() ) {
                        ?>
                            <tr>
                                <td><?php echo $row['nome']; ?></td>
                                <td>
                                <?php
                                $sql1 = "SELECT setores.setor FROM setores INNER JOIN usuario_setor ON usuario_setor.usuario = {$row['id']} AND setores.id = usuario_setor.setor";
                                    $res1 = $conn->query( $sql1 )or die ( mysqli_error($conn));
                                    while ( $row1 = $res1->fetch_assoc() ) {
                                ?>
                                <?php echo $row1['setor']; ?>
                                <?php } ?>
                                </td>
                                <td><?php if($row['nivel'] === '1'){ echo 'Administrador';}
                                    if($row['nivel'] === '2'){ echo 'Coordenador';}
                                    if($row['nivel'] === '3'){ echo 'Analista';}
                                    if($row['nivel'] === '4'){ echo 'Supervisor';}
                                    if($row['nivel'] === '5'){ echo 'Colaborador';}
                                    if($row['nivel'] === '6'){ echo 'Personalizado';}
                                    ?></td>
                                <td>
                                    <ul class="btnaction">
                                        <li data-toggle="tooltip" title="Editar">
                                            <a href="colaborador-editar.php?p=<?php echo $row['id']; ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-html="true"
                                                 data-toggle="popover"
                                                 data-placement="top"
                                                 data-content="<a href='inc/remover.php?r=<?php echo $row['id']; ?>&t=col'><i>Sim</i></a>"
                                                 title="<b>Tem certeza que deseja remover essa atividade?</b>">
                                                 <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Remover"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
