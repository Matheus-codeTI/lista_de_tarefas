<?php
session_start();

include '../config/conexao.php';
include '../config/func.php';

$login = $_POST['login'] ?? null;
$senha = $_POST['senha'] ?? null;

if (!$login || !$senha) {
    $msg = "=) <br>usuário e/ou senha inválidos.";
    header("location: ../index.php?msg=" . $msg);
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

        if ($rowUsuario[3] == 'a') {
            if ($rowUsuario[2] == $senha) {
                $_SESSION['idlogin'] = $rowUsuario[0];
                $_SESSION['login'] = $rowUsuario[1];
                $_SESSION['senha'] = $rowUsuario[2];

                header("Location: ../listaDeTarefas.php");
            } else {
                $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Senha incorreta!";
                header("location: ../index.php?msg=" . $msg);
            }
        } else {
            $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Usuário desativado";
            header("location: ../index.php?msg=" . $msg);
        }
    } else {
        $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Usuário não encontrado!";
        header("location: ../index.php?msg=" . $msg);
    }
}