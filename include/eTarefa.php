<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php

include '../config/conexao.php';
include '../config/func.php';

$id = $_POST['idtarefa'];

// PEGA A DATA ATUAL 
$dataAtual = date('Y-m-d');

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$horaAtual = date('H:i:s', time());

$consultaTarefa = "SELECT
                        idtarefa,
                        usuario,
                        datafim,
                        horafim
                from tarefa where idtarefa = '$id'";
$queryTarefa = mysqli_query($con, $consultaTarefa);
$rowTarefa = mysqli_fetch_array($queryTarefa);

$excluirTarefa = "DELETE FROM tarefa where idtarefa = '$id'";
if (mysqli_query($con, $excluirTarefa)) {

    $logTarefa = "INSERT INTO logtarefa values(null,
                                                ' " . ucfirst($rowTarefa[1]) . " Excluiu uma tarefa no dia " . dataBuscaBanco($dataAtual) . "',
                                                '$dataAtual',
                                                '$horaAtual')";
    mysqli_query($con, $logTarefa);

    header("location: ../listaDeTarefas.php");
} else {
    header("location: ../listaDeTarefas.php");
}
?>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 