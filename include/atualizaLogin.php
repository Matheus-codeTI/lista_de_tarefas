<?php

include '../config/conexao.php';
include '../config/func.php';

$id = $_GET['idlogin'];

$login = $_POST['login'];
$status = $_POST['status'];

$atualizaUsuario = " UPDATE login set
                                    login = '{$login}',
                                    status = '{$status}'
                            where idlogin = '$id'";
if (mysqli_query($con, $atualizaUsuario)) {
    $msg = "Usuário <b>" . ucfirst($login) . "</b> Atualizado com sucesso !";
    $acao = 0;
} else {
    $msg = "Erro ao atualizado usuário: <b>{$login}</b> ";
    $acao = 1;
}
header("location: ../cadastrarLogin.php?msg=$msg&acao=$acao");
