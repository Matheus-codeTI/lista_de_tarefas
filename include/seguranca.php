<?php

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])) {
    $msg = "Você não pode acessar esse sistema !";
    header("location: ./semAcesso.php?msg=$msg");
    session_destroy();
    exit;
}