<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php
session_start();
include './config/conexao.php';
include './config/func.php';
include './include/seguranca.php';
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
                color: #5A5A5A;
                opacity: 2s;
                font-size: 14px;
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
            /* CSS DA TABELA */
            element.style {
                width: 539.609px;
            }
            .table.dataTable.table-sm>thead>tr>th {
                padding-right: 20px;
            }
            .table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
                padding-right: 30px;
            }
            .table.table-bordered.dataTable th, table.table-bordered.dataTable td {
                border-left-width: 0;
            }
            .table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled {
                cursor: pointer;
                position: relative;
            }
            .table.dataTable td, table.dataTable th {
                -webkit-box-sizing: content-box;
                box-sizing: content-box;
            }
            .table-bordered thead td, .table-bordered thead th {
                border-bottom-width: 2px;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }
            .table-bordered td, .table-bordered th {
                border: 2px solid #dee2e6;
            }
            .table-sm td, .table-sm th {
                padding: 0.3rem;
            }
            .table td, .table th {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            .th {
                text-align: inherit;
            }
            *, ::after, ::before {
                box-sizing: border-box;
            }
            .user agent stylesheet
            .th {
                display: table-cell;
                vertical-align: inherit;
                font-weight: bold;
                text-align: -internal-center;
            }
            .table.dataTable {
                clear: both;
                margin-top: 6px !important;
                margin-bottom: 6px !important;
                max-width: none !important;
                border-collapse: separate !important;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }
            .table {
                border-collapse: collapse;
            }
            user agent stylesheet
            .table {
                border-collapse: separate;
                text-indent: initial;
                border-spacing: 2px;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Select2
                $('.select2').select2();
                // DataPicker
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
                // Tabela 
                $('#table').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                    }
                });
                // verificação de confirmação de senha
                $('#confirm_password').on('keyup', function () {
                    var password1 = $('#password').val();
                    var password2 = $('#confirm_password').val();

                    if (password1 === password2) {
                        $('#confirm_password').removeClass('is-invalid').addClass('is-valid');
                        $('#password-feedback').html('As senhas coincidem.').removeClass('invalid-feedback').addClass('valid-feedback');
                        $("#botao").attr("disabled", false);
                    } else {
                        $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
                        $('#password-feedback').html('As senhas não coincidem.').removeClass('valid-feedback').addClass('invalid-feedback');
                        $("#botao").attr("disabled", true);
                    }
                    // verifica se a senha confirmada é igual a senha
                    $('#password').on('keyup', function () {
                        var password1 = $('#password').val();
                        var password2 = $('#confirm_password').val();

                        if (password2 === password1) {
                            $('#confirm_password').removeClass('is-invalid').addClass('is-valid');
                            $('#password-feedback').html('As senhas coincidem.').removeClass('invalid-feedback').addClass('valid-feedback');
                            $("#botao").attr("disabled", false);
                        } else {
                            $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
                            $('#password-feedback').html('As senhas não coincidem.').removeClass('valid-feedback').addClass('invalid-feedback');
                            $("#botao").attr("disabled", true);
                        }
                    });
                });

                // Detecta quando o usuário sai do campo de entrada
                $("input").blur(function () {
                    // Verifica se o campo está vazio
                    if ($("#confirm_password").val() === '' && $("#password").val() === '') {
                        // Remove a classe "is-valid" do elemento
                        $("#confirm_password").removeClass("is-valid");
                    }
                });


            });

            function EditaLogin(idlogin) {
                $('#mUsarios').modal('show');
                $.ajax({
                    url: './mAtualizaUsuario.php',
                    type: 'POST',
                    data: {
                        "idlogin": idlogin
                    },
                    success: function (data) {
                        $("#usuarios").html(data);
                        $('.select2').select2();
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }


            function ExcluiUsuario(idlogin) {
                $('#mExcluiUsuario').modal('show');
                $.ajax({
                    url: './mExcluirUsuario.php',
                    type: 'POST',
                    data: {
                        "idlogin": idlogin
                    },
                    success: function (data) {
                        $("#excluiUsuario").html(data);
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }


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
                        <li class="breadcrumb-item"><i style="color: #4723D9; font-size: 20px; margin-right: 08px;" class='bx bxs-user-circle mt-4'></i> </li>                            
                        <li style="font-size: 14px;" class="mt-4">/ Cadastro de login </li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['acao']) && $_GET['msg']) {
                    echo montaAlert($_GET['acao'], $_GET['msg']);
                }
                ?>
            </main>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="clearfix middle shadow-lg bg-white p-3">
                    <form method="POST" action="include/glogin.php">
                        <h5 class="text-center">Cadastrar Login <i class='bx bxs-user-rectangle'></i></h5>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <label class="form-label"><i class='bx bxs-user-circle'></i> Login: <span style="color: red">*</span></label>
                                <input required autocomplete="off" class="form-control" name="login" type="text" >
                            </div>
                        </div>
                        <div class="row mt-2">  
                            <div class="col-lg-6">
                                <label class="form-label mt-3"><i class='bx bxs-lock-alt'></i> Senha: <span style="color: red">*</span></label>
                                <input type="password" autocomplete="off" name="senha" class="form-control" placeholder="Senha" id="password" required />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label class="form-label mt-3"><i class='bx bxs-lock'></i> Confirme a senha: <span style="color: red">*</span></label>
                                <input type="password" autocomplete="off" class="form-control" placeholder="Confirme a Senha" id="confirm_password" required />
                                <div id="password-feedback"></div>
                            </div>
                        </div>
                        <button id="botao" type="submit" class="btn btn-primary mt-3">Cadastrar <i class='bx bx-save'></i></button>
                    </form>
                    <span style="color: red; font-size: 12px;">Obrigatório *</span>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="clearfix middle shadow-sm bg-white p-3">
                    <h5 class="text-center">Tabela de usuários <i class='bx bxs-user-rectangle'></i></h5>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th scope="row">Login</th>
                                    <th scope="row">Status</th>
                                    <th scope="row">Editar</th>
                                    <th scope="row">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $login = " SELECT
                                                idlogin,
                                                login,
                                                senha,
                                                status
                                            from login";
                                $queryLogin = mysqli_query($con, $login);
                                while ($rowLogin = mysqli_fetch_array($queryLogin)) {
                                    ?>
                                    <tr>
                                        <td scope="row"><?= $rowLogin[0] ?></td>
                                        <td scope="row"><?= $rowLogin[1] ?></td>
                                        <td class="col-2">
                                            <?php
                                            if ($rowLogin[3] == 'a') {
                                                echo "<span style='text-decoration: none' class='badge badge-success'>Ativo <i class= 'bx bx-like'></i></span>";
                                            } else {
                                                echo "<span style='text-decoration: none' class='badge badge-danger'>Inativo <i class='bx bx-dislike'></i></span>";
                                            }
                                            ?>
                                        </td>
                                        <td class="col-1">
                                            <button onclick="EditaLogin('<?= $rowLogin[0] ?>')" class="btn btn-primary" >
                                                <i style="color: white; cursor: pointer" class='bx bxs-edit'></i>
                                            </button>
                                        </td>
                                        <td class="col-1">
                                            <button onclick="ExcluiUsuario('<?= $rowLogin[0] ?>')" class="btn btn-danger">
                                                <i style="cursor: pointer; color: white" class='bx bxs-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAIS-->
        <?php
        include './include/modais.php';
        ?>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 