<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
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
    header("location: ../listaDeTarefas.php");
} else {
    header("location: ../listaDeTarefas.php");
}
?>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 