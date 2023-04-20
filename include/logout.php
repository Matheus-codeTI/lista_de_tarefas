<?php
session_start();
$msg = "Você foi desconectado com sucesso.";

header("location: ../login.php?msg=$msg");
