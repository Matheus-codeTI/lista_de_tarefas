<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
<?php

include '../config/conexao.php';
include '../config/func.php';

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$horaAtual = date('H:i:s', time());

// PEGA A DATA ATUAL 
$dataAtual = date('Y-m-d');

$idTarefa = $_GET['idtarefa'];

$usuario = $_POST['usuario'];
$idprioridade = $_POST['tipotarefa'];
$datainicio = $_POST['datainicio'];
$datafinal = $_POST['datafinal'];
$horainicio = $_POST['horainicio'];
$horafinal = $_POST['horafinal'];

$atualizaTarefa = "UPDATE tarefa set
                                    idprioridade = '{$idprioridade}',
                                    usuario = '{$usuario}',
                                    datager = '" . dataBanco($datainicio) . "',
                                    horager = '{$horainicio}',
                                    datafim = '" . dataBanco($datafinal) . "',
                                    horafim = '{$horafinal}'
                            where idtarefa = '$idTarefa'";
if (mysqli_query($con, $atualizaTarefa)) {

//    INICIO DA INSERÇÃO NA TABELA LOGTAREFA
    $logTarefa = "INSERT INTO logtarefa values(null,
                                                ' " . ucfirst($usuario) . " Atualizou uma tarefa no dia " . dataBuscaBanco($dataAtual) . " ás $horaAtual',
                                                '$dataAtual',
                                                '$horaAtual')";
    mysqli_query($con, $logTarefa);
//    FIM DA INSERÇÃO NA TABELA LOGTAREFA 

    $msg = "Tarefa Atualizada com sucesso !";
    $acao = 0;
    header("location: ../listaDeTarefas.php?acao=$acao&msg=$msg");
} else {
    $msg = "Erro ao atualizar tarefa";
    $acao = 1;
    header("location: ../listaDeTarefas.php?acao=$acao&msg=$msg");
}
?>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com-->            

