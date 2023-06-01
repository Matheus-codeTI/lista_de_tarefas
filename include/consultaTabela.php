<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
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
    $horaFinal = new DateTime($rowTarefa[6]);

    $dataAtual = new DateTime($data);
    $horaAtual = new DateTime($hora);

//    UPDATE STATUS
    $status = '';
    if ($dataAtual >= $dataFinal && $horaAtual > $horaFinal) {
        $update = "update tarefa set status = 'e' where idtarefa = {$rowTarefa[0]}";
        $status = 'e';
        mysqli_query($con, $update);
    }
    ?>
    <tr>
        <td scope="row"><?= $rowTarefa[0] ?></td>
        <td scope="row"><?= $rowTarefa[1] ?></td>
        <td class="col-3"><?= $rowTarefa[2] ?></td>
        <td scope="row"><?= databuscabanco($rowTarefa[3]) ?> | <?= substr($rowTarefa[4], 0, -3) ?></td>
        <td scope="row"><?= dataBuscaBanco($rowTarefa[5]) ?> | <?= substr($rowTarefa[6], 0, -3) ?></td>
        <td class="col-0">
            <?php
            if ($rowTarefa[7] == 'r') {
                echo "<span style='text-decoration: none' class='badge badge-success'>Realizada <i class= 'bx bx-like'></i></span>";
//              UPDATE DO STATUS PARA 'R' DE REALIZADO
                $update = "update tarefa set status = 'r' where idtarefa = {$rowTarefa[0]}";
                mysqli_query($con, $update);
            } else {
                if ($rowTarefa[7] == 'e' || $status == 'e') {
                    echo "<span style='text-decoration: none;' class='badge badge-default'>Expirada <i class='bx bx-info-circle'></i></span>";
                } elseif ($rowTarefa[7] == 'a') {
                    echo "<span style='text-decoration: none' class='badge badge-info'>Andamento <i class= 'bx bx-cog'></i></span>";
                } elseif ($rowTarefa[7] == 'p') {
                    echo "<span style='text-decoration: none' class='badge badge-warning'>Pendente <i class='bx bx-info-circle'></i></span>";
                }
            }
            ?>
        </td>
        <!-- REALIZAR TAREFA-->
        <td>
            <?php
            switch ($rowTarefa[7]) {
                case 'r':
                    ?>
                    <button onclick="tarefaConcluida()" class="badge badge-success">Concluída <i style="font-size: 17px;" class='bx bx-check-circle'></i></button>
                    <?php
                    break;
                case ($dataAtual >= $dataFinal && $horaAtual > $horaFinal):
                    ?>
                    <button onclick="tarefaExpirada()" class="badge badge-warning">Tarefa expirada <i style="font-size: 17px;" class='bx bx-info-circle'></i></button>
                    <?php
                    break;
                case 'p':
                    ?>
                    <button onclick="IniciarTarefa('<?= $rowTarefa[0] ?>', '<?= $rowTarefa[7] ?>')" class="badge badge-info">Iniciar Tarefa <i style="font-size: 17px;" class='bx bx-play-circle' ></i></button>
                    <?php
                    break;
                case 'a':
                    ?>
                    <button onclick="RealizarTarefa('<?= $rowTarefa[0] ?>', '<?= $rowTarefa[7] ?>')" class="badge badge-success">Realizar Tarefa <i style="font-size: 17px;" class='bx bx-calendar-check' ></i></button>
                    <?php
                    break;
                case 'e':
                    ?>
                    <button onclick="tarefaExpirada()" class="badge badge-warning">Tarefa expirada <i style="font-size: 17px;" class='bx bx-info-circle'></i></button>
                    <?php
                    break;
            }
            ?>
        </td>
        <!-- CAMPO EDITAR--> 
        <td>
            <?php
            switch ($rowTarefa[7]) {
                case 'r':
                    ?>
                    <button onclick="EditaTarefaJaRealizada('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#tarefaJaRealizada" class="btn btn-primary"><i class='bx bxs-edit'></i></button>
                    <?php
                    break;
                case ($dataAtual >= $dataFinal && $horaAtual > $horaFinal):
                    ?>
                    <button onclick="EditaTarefaJaRealizada('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#tarefaJaRealizada" class="btn btn-primary"><i class='bx bxs-edit'></i></button>
                    <?php
                    break;
                case 'a':
                case 'p':
                    ?>
                    <button onclick="atualizaTarefa('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#Atualizatarefa" class="btn btn-primary"><i class='bx bxs-edit'></i></button>
                    <?php
                    break;
                case 'e':
                    ?>
                    <button onclick="EditaTarefaJaRealizada('<?= $rowTarefa[0] ?>')" data-bs-toggle="modal" data-bs-target="#tarefaJaRealizada" class="btn btn-primary"><i class='bx bxs-edit'></i></button>
                        <?php
                        break;
                }
                ?>
        </td>
    </tr>
    <?php
}
?>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
