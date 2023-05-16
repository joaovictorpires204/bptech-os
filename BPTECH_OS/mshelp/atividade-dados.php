        <div class="ftabela mt40px">
            <div class="ftabela-content">

                <table class="table">
                    <thead>
                        <tr>
                            <th>SETOR</th>
                            <th>ATIVIDADE</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM atividades ORDER BY setor";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row = $res->fetch_assoc() ) {
                        ?>
                            <tr>
                                <?php
                                $sql1 = "SELECT * FROM setores WHERE id = {$row['setor']}";
                                    $res1 = $conn->query( $sql1 )or die ( mysqli_error($conn));
                                    while ( $row1 = $res1->fetch_assoc() ) {
                                ?>
                                <td><?php echo $row1['setor']; ?></td>
                                <?php } ?>
                                <td><?php echo $row['atividade']; ?></td>
                                <td>
                                    <ul class="btnaction">
                                        <li data-toggle="tooltip" title="Editar">
                                            <a href="atividade-editar.php?p=<?php echo $row['id']; ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-html="true"
                                                 data-toggle="popover"
                                                 data-placement="top"
                                                 data-content="<a href='inc/remover.php?r=<?php echo $row['id']; ?>&t=ati'><i>Sim</i></a>"
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
