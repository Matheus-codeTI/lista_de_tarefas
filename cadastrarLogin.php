<?php
include './config/conexao.php';
include './config/func.php';
?>
<html>
    <head>
        <title>Cadastrar Login</title>
        <!--SELECT2-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!--CSS-->
        <link rel="stylesheet" href="css/estilo.css"/>
        <link rel="stylesheet" href="css/loader.css"/>

        <!--ICONS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>

        <!--DATA TABLE-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!--DATA PICKER-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

        <!--BOOTSTRAP-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .body{
                background-color: #f1f1f1;
                z-index: 99999;
                font-size: 14px;
                color: #5A5A5A;
                opacity: 2s;
            }
            .botao {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
                border-radius: 50px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
            .select2-container{
                z-index: 9999999;
            }
            .badge.badge-success {
                background: transparent;
                border-color: #22af46;
                color: #22af46;
            }
            .badge.badge-danger {
                background: transparent;
                border-color: #de4848;
                color: #de4848;
            }
            .badge.badge-info {
                background: transparent;
                border-color: #3C89DA;
                color: #3C89DA;
            }
            .badge {
                font-weight: 400;
                padding: 4px 8px;
                text-transform: uppercase;
                border: 1px solid;
            }
            .badge.badge-warning {
                background: transparent;
                border-color: #f3ad06;
                color: #f3ad06;
            }
            .badge.badge-default {
                background: transparent;
                border-color: #9A9A9A;
                color: #9A9A9A;
            }
            *::-webkit-scrollbar{
                width: 0;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#datepicker').datepicker({
                    format: "dd/mm/yyyy",
                    todayBtn: "linked",
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    language: 'pt-br',
                    zIndexOffset: 99999999,
                    orientation: 'bottom'
                });
            });
            // TEMPO DE LOADER
            setTimeout(() => {
                document.getElementById('pagina').style.display = 'none';
            }, 300);
        </script>
    </head>
    <!--NAVE LATERAL--> 
    <?php include './naveLateral.php'; ?>
    <body class="body">
        <!--LOADER DA PÁGINA-->
        <div id="pagina" class="page-loader-wrapper">
            <div class="loader">
                <div class="ball"></div>
                <div class="ball"></div>
                <div class="ball"></div>
            </div>
            <div class="text">Carregando...</div>
        </div>
        <div class="row">
            <main class="breadcrumb-item active" style="margin-top: 70px;">
                <div class="col-lg-6">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><i style="color: green; font-size: 20px; margin-right: 08px;" class="bx bx-task mt-4"></i> </li>                            
                        <li style="font-size: 14px;" class="mt-4">/ Lista de Tarefas </li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['acao']) && $_GET['msg']) {
                    echo montaAlert($_GET['acao'], $_GET['msg']);
                }
                ?>
            </main>
            <form method="POST" action="action">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="clearfix middle shadow-sm bg-white p-3">
                        <h5 class="text-center">Cadastrar Login</h5>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label class="form-label"><i class='bx bxs-user-circle'></i> Login:</label>
                                <input class="form-control" type="text" >
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label"><i class='bx bxs-lock-alt'></i> Senha:</label>
                                <input class="form-control" type="password" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
        <!--BOOTSTRAP-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <!--DATA TABLE-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <!--Icons-->
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <!--date picker-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--SELECT2-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!--SWEETALERT2-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--SCRIPT--> 
        <script src="script/javascript.js"></script>
    </body>
</html>
