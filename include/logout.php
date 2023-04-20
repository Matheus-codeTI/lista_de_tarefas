<?php
session_start();
$msg = "Você foi desconectado com sucesso.";

header("location: ../index.php?msg=$msg");
