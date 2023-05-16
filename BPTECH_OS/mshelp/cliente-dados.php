        <div class="ftabela mt40px">
            <div class="ftabela-content">

                <table class="table">
                    <thead>
                        <tr>
                            <th width='80%'>NOME</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM clientes ORDER BY cliente";
                            $res = $conn->query( $sql )or die ( mysqli_error($conn));
                            while ( $row = $res->fetch_assoc() ) {
                        ?>
                            <tr>
                                <td><?php echo $row['cliente']; ?></td>
                                <td>
                                    <ul class="btnaction">
                                        <li data-toggle="tooltip" title="Editar">
                                            <a href="cliente-editar.php?p=<?php echo $row['id']; ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-html="true"
                                                 data-toggle="popover"
                                                 data-placement="top"
                                                 data-content="<a href='inc/remover.php?r=<?php echo $row['id']; ?>&t=cli'><i>Sim</i></a>"
                                                 title="<b>Tem certeza que deseja remover esse cliente?</b>">
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
