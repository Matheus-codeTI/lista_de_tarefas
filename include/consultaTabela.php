<?php
include '../config/conexao.php';
include '../config/func.php';

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$hora = date('H:i:s', time());
$data = date('Y-m-d');

$listaDeTarefas = "Select
                        idtarefa,
                        usuario,
                        tarefa,
                        datager,
                        horager,
                        datafim,
                        horafim,
                        status
                from tarefa";
$queryTarefa = mysqli_query($con, $listaDeTarefas);
while ($rowTarefa = mysqli_fetch_array($queryTarefa)) {

    $dataFinal = new DateTime($rowTarefa[5]);
    $HoraFinal = new DateTime($rowTarefa[6]);

    $dataAtual = new DateTime($data);
    $horaAtual = new DateTime($hora);

//   UPDATE STATUS
    $status = '';
    if ($dataAtual >= $dataFinal && $horaAtual > $HoraFinal) {
        $update = "update tarefa set status = 'p' where idtarefa = {$rowTarefa[0]}";
        $status = 'p';
        mysqli_query($con, $update);
    }
    ?>
    <tr>
        <th scope="row"><?= $rowTarefa[0] ?></th>
        <td scope="row"><?= $rowTarefa[1] ?></td>
        <td class="col-3"><?= $rowTarefa[2] ?></td>
        <td scope="row"><?= databuscabanco($rowTarefa[3]) ?> | <?= $rowTarefa[4] ?></td>
        <td scope="row"><?= dataBuscaBanco($rowTarefa[5]) ?> | <?= $rowTarefa[6] ?></td>
        <td class="col-0">
            <?php
            if ($rowTarefa[7] == 'p' || $status == 'p') {
                echo "<span style='text-decoration: none' class='badge badge-warning'>Pendente <i class='bx bx-info-circle'></i></span>";
            } elseif ($rowTarefa[7] == 'a') {
                echo "<span style='text-decoration: none' class='badge badge-info'>Andamento <i class= 'bx bx-cog'></i></span>";
            } elseif ($rowTarefa[7] == 'r') {
                echo "<span style='text-decoration: none' class='badge badge-success'>Realizada <i class= 'bx bx-like'></i></span>";
            }
            ?>
        </td>
        <!-- REALIZAR TAREFA-->
        <td>
            <?php
            if ($dataAtual >= $dataFinal && $horaAtual > $HoraFinal) {
                ?>
                <button onclick="tarefaNaoRealizada()" class="badge badge-warning">Tarefa não realizada</button>
                <?php
            } else {

                if ($rowTarefa[7] == 'a') {
                    ?>
                    <button onclick="mudaStatusTarefa('<?= $rowTarefa[0] ?>', '<?= $rowTarefa[7] ?>')" class="badge badge-success">Realizar tarefa <i class= 'bx bx-like'></i></button>
                    <?php
                } elseif ($rowTarefa[7] == 'r') {
                    ?>
                    <button onclick="tarefaRealizada()" class="badge badge-danger">Tarefa realizada <i class='bx bx-x-circle'></i></button>
                    <?php
                } else {
                    ?>
                    <button onclick="tarefaNaoRealizada()" class="badge badge-warning">Tarefa não realizada</button>
                    <?php
                }
            }
            ?>
        </td>
        <!-- CAMPO EDITAR--> 
        <td>
            <?php
            if ($dataAtual >= $dataFinal && $horaAtual > $HoraFinal) {
                ?>
                <button onclick="EditaTarefaJaRealizada('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#tarefaJaRealizada"  class="btn btn-primary" ><i class='bx bxs-edit'></i></button>
                <?php
            } else {

                if ($rowTarefa[7] == 'a') {
                    ?>
                    <button onclick="atualizaTarefa('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#Atualizatarefa" class="btn btn-primary" ><i class='bx bxs-edit'></i></button>
                    <?php
                } elseif ($rowTarefa[7] == 'p') {
                    ?>
                    <button onclick="EditaTarefaJaRealizada('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#tarefaJaRealizada"  class="btn btn-primary" ><i class='bx bxs-edit'></i></button>
                    <?php
                } else {
                    ?>
                    <button disabled="" class="btn btn-primary" ><i class='bx bxs-edit'></i></button>
                        <?php
                    }
                }
                ?>
        </td>
    </tr>
    <?php
}
?>
