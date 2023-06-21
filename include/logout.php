<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php

session_start();
session_destroy();
$msg = "Você foi desconectado com sucesso.";

header("location: ../index.php?msg=$msg");
