<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])) {
    $msg = "Você não pode acessar esse sistema !";
    header("location: ./semAcesso.php?msg=$msg");
    session_destroy();
    exit;
}