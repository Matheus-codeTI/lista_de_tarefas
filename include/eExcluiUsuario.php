<?php

include '../config/conexao.php';
include '../config/func.php';

$id = (int) $_GET['idlogin'];

$deletaUsuario = " DELETE FROM login where idlogin = '$id'";
if (mysqli_query($con, $deletaUsuario)) {
    $msg = " Usuário deletado com sucesso !";
    $acao = 0;
} else {
    $msg = " Erro ao deletar usuário !";
    $acao = 1;
}
header("location: ../cadastrarLogin.php?msg=$msg&acao=$acao");
