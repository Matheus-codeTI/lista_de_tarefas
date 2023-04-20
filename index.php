<?php
include './config/conexao.php';
include './config/func.php';
?>
<html>
    <head>
        <title>Login</title>
        <!--ICONS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>

        <!--BOOTSTRAP-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <style>
        body{
            background-image: url("imagens/imagem04.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-size: 14px;
        }
        .container{
            margin-top: 25vh;
        }
        #msg{
            transition: opacity 0.2s ease-in-out;
        }
    </style>
    <script>
        setTimeout(function () {
            document.getElementById('msg').style.display = 'none';
        }, 4000); // Esconde a mensagem depois de 4 segundos
    </script>
    <body>
        <form method="POST" action="include/consultaLogin.php">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-lg-4 col-md-7 col-sm-12">
                        <div class="clearfix middle shadow-lg bg-white p-4">
                            <div class="text-center">
                                <?php
                                if (!empty($_GET["msg"])) {
                                    $msg = $_GET["msg"];
                                    echo "<br><h6 id='msg' style='color: red;'>" . $msg . "<br> </h6>";
                                }
                                ?>
                                <h4>Acesso ao sistema</h4>
                            </div>
                            <small><label class="form-label">Login:</label></small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class='bx bxs-user-circle'></i></span>
                                <input type="text" name="login" class="form-control" required="">
                            </div>
                            <small><label class="form-label">Senha:</label></small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class='bx bxs-lock-alt'></i></span>
                                <input type="password" name="senha" class="form-control" required="">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Acessar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
