<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com-->
<?php
include '../config/conexao.php';
include '../config/func.php';

// PEGA A DATA ATUAL 
$dataAtual = date('Y-m-d');

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$horaAtual = date('H:i:s', time());

$idTipotarefa = $_POST['tipotarefa'];
$usuario = $_POST['usuario'];
$dataInicio = dataBanco($_POST['datainicio']);
$dataFim = dataBanco($_POST['datafinal']);
$horaInicio = $_POST['horainicio'];
$horaFim = $_POST['horafinal'];
$tarefa = $_POST['tarefa'];

// CONVERTER A DATA E HORA EM STRTOTIME
$inicio = strtotime(date("$dataInicio $horaInicio"));
$fim = strtotime(date("$dataFim $horaFim"));
$agora = strtotime(date("Y-m-d H:i:s"));

if ($inicio > $fim) {
    $acao = 1;
    $msg = "A data de início não pode ser maior que a data final, por favor cadastre outra data.";
    header("Location: ../listaDeTarefas.php?msg=$msg&acao=$acao");
    exit;
} elseif ($fim < $agora) {
    $acao = 1;
    $msg = "A data final não pode ser menor que a data atual.";
    header("Location: ../listaDeTarefas.php?msg=$msg&acao=$acao");
    exit;
} elseif ($fim < $inicio) {
    $acao = 1;
    $msg = "A data final não pode ser menor que a data de início, por favor cadastre outra data.";
    header("Location: ../listaDeTarefas.php?msg=$msg&acao=$acao");
    exit;
}
$insertTarefa = "INSERT INTO tarefa values(null,
                                    '$idTipotarefa',
                                    '$usuario',
                                    '$tarefa',
                                    '" . dataBanco($dataInicio) . "',
                                    '$horaInicio',
                                    '" . dataBanco($dataFim) . "',
                                    '$horaFim',
                                    'p')";
if (mysqli_query($con, $insertTarefa)) {

    $logTarefa = "INSERT INTO logtarefa values(null,
                                                ' " . ucfirst($usuario) . " cadastrou uma tarefa no dia " . dataBuscaBanco($dataAtual) . " , para ser realizada até o dia " . dataBuscaBanco($dataFim) . " ás $horaFim ',
                                                '$dataAtual',
                                                '$horaAtual')";
    mysqli_query($con, $logTarefa);

    $acao = 0;
    $msg = "Tarefa cadastrada com sucesso !";
    header("location: ../listaDeTarefas.php?msg=$msg&acao=$acao");
    exit;
} else {
    $acao = 1;
    $msg = "Erro ao cadastrar tarefa";
    header("location: ../listaDeTarefas.php?msg=$msg&acao=$acao");
    exit;
}
?>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 