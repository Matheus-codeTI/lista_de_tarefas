<?php

session_start();
include '../config/conexao.php';
include '../config/func.php';

$login = $_POST['login'];
$senha = $_POST['senha'];

if ($login == null || $senha == null) {
    $msg = "=) <br>usuário e/ou senha inválidos.";
    header("location: ../login.php?msg=" . $msg);
} else {
    $consultaDeUsuario = "Select
                            idlogin,
                            login,
                            senha,
                            status
                    from login where login = '$login'";

    $queryDeUsuario = mysqli_query($con, $consultaDeUsuario);
    if (mysqli_num_rows($queryDeUsuario) > 0) {

        $rowUsuario = mysqli_fetch_array($queryDeUsuario);
        if ($rowUsuario[2] == $senha) {
            if ($rowUsuario[3] == 'a') {

                $_SESSION['idlogin'] = $rowUsuario[0];
                $_SESSION['login'] = $rowUsuario[1];
                $_SESSION['senha'] = $rowUsuario[2];

                header("Location: ../index.php");
            } else {
                $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Usuário desativado ou inexistente";
                header("location: ../login.php?msg=" . $msg);
            }
        } else {
            $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Senha incorreta!";
            header("location: ../login.php?msg=" . $msg);
        }
    } else {
        $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Esse usuário não existe em nosso sistema!";
        header("location: ../login.php?msg=" . $msg);
    }
}