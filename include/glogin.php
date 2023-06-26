<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php

include '../config/conexao.php';
include '../config/func.php';

$login = $_POST['login'];
$senha = $_POST['senha'];

$cadastraLogin = "INSERT INTO login values(null,
                                    '$login',
                                    '$senha',
                                    'a')";
if (mysqli_query($con, $cadastraLogin)) {
    $msg = 'Login cadastrado com sucesso';
    $acao = 0;
} else {
    $msg = 'Erro ao cadastrar login';
    $acao = 1;
}
header("location: ../cadastrarLogin.php?msg=$msg&acao=$acao");
