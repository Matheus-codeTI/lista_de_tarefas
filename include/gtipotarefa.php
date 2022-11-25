<?php

include '../config/conexao.php';
include '../config/func.php';

$tipoTarefa = $_POST['tipotarefa'];

$consultaNomeTarefa = "select
                            tipo
                    from prioridade 
                    where tipo = '$tipoTarefa'";
$queryNomeTarefa = mysqli_query($con, $consultaNomeTarefa);
if (mysqli_num_rows($queryNomeTarefa) > 0) {
    $msg = "Esse tipo de tarefa já existe, por favor cadastre outro nome";
    $acao = 1;
    header("location: ../index.php?msg=$msg&acao=$acao");
} else {
    $insertTipoTarefa = "INSERT INTO prioridade values (null,
                                                '$tipoTarefa')";
    if (mysqli_query($con, $insertTipoTarefa)) {
        $acao = 0;
        $msg = "Tipo de tarefa cadastrada com sucesso !";
        header("location: ../index.php?msg=$msg&acao=$acao");
    } else {
        $acao = 1;
        $msg = "Erro ao cadastrar tipo de tarefa";
        header("location: ../index.php?msg=$msg&acao=$acao");
    }
}

