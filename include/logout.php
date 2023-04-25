<?php

session_start();
session_destroy();
$msg = "Você foi desconectado com sucesso.";

header("location: ../index.php?msg=$msg");
