<?php
include '../config/conexao.php';
include '../config/func.php';
?>
<div class="modal-header">
    <h4 class="modal-title">Histórico de tarefa</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body"> 
    <div class="table-responsive">
        <table id="tableHistorico" class="table table-sm table-bordered table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">descrição</th>
                    <th scope="row">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $listaDeTarefas = "Select
                                        idlogtarefa,
                                        descricao,
                                        datager,
                                        horager
                                    from logtarefa";
                $queryTarefa = mysqli_query($con, $listaDeTarefas);
                while ($rowTarefa = mysqli_fetch_array($queryTarefa)) {
                    $date = explode(" ", $rowTarefa[2])[0];
                    $time = explode(" ", $rowTarefa[3])[0];
                    ?>
                    <tr>
                        <th scope="row"><small><?= $rowTarefa[0] ?></small></th>
                        <td style="white-space: pre-wrap;"><small><?= $rowTarefa[1] ?></small></td>
                        <td><small><?= dataBuscaBanco($date) . " às " . $time ?></small></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> fechar <i class='bx bx-x-circle'></i></button>
</div>
