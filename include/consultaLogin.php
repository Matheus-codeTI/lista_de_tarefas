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
                    from login where login = '$login'
                    and senha = '$senha' and status = 'a'";
    
    if ($queryDeUsuario = mysqli_query($con, $consultaDeUsuario)) {
        $rowUsuario = mysqli_fetch_array($queryDeUsuario);
                
        if (!password_verify($senha, $rowUsuario[2])) {
            if (isset($rowUsuario)) {

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
        $msg = "<i class='bx bx-frown-o' aria-hidden='true'></i> <br> Erro ao procurar usuário!";
        header("location: ../login.php?msg=" . $msg);
    }
}