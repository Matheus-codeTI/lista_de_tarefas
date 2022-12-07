<?php

include '../config/conexao.php';
include '../config/func.php';

$idtarefa = $_POST['idtarefa'];
$status = $_POST['status'];

if ($status == 'p') {
    $update = "update tarefa set status = 'a' where idtarefa = {$idtarefa}";
} elseif ($status == 'a') {
    $update = "update tarefa set status = 'r' where idtarefa = {$idtarefa}";
}
if (mysqli_query($con, $update)) {
    header("location: ../index.php");
} else {
    header("location: ../index.php");
}