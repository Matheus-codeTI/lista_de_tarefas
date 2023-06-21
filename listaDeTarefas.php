<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php
session_start();

include './config/conexao.php';
include './config/func.php';
include './include/seguranca.php';

$hoje = date('d/m/Y');
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de tarefas</title>
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
                buscaTabela();
                $('.select2').select2();
                $('.date').datepicker({
                    format: "dd/mm/yyyy",
                    todayBtn: "linked",
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    language: 'pt-BR',
                    zIndexOffset: 99999999,
                    orientation: 'bottom'
                });
                setTimeout(() => {
                    document.getElementById('pagina').style.display = 'none';
                }, 300);
            });

            function realizaTarefa() {
                Swal.fire({
                    title: 'Tarefa realizada com sucesso!',
                    text: 'Prossiga com a ação e click no botão',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            }
            function iniciaTarefa() {
                Swal.fire({
                    title: 'Tarefa Iniciada !',
                    text: 'Prossiga com a ação e click no botão',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            }
            function tarefaConcluida() {
                Swal.fire({
                    icon: 'info',
                    title: 'Essa tarefa já foi realizada!',
                    text: 'Assim que a tarefa é realizada, não tem como mudar os status da tarefa',
                    confirmButtonText: 'OK'
                })
            }
            function tarefaExpirada() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Essa tarefa não foi cumprida a tempo!',
                    text: 'O tempo de realizar essa tarefa foi esgotado !',
                    confirmButtonText: 'OK'
                })
            }
            function TarefaExcluida() {
                Swal.fire({
                    icon: 'success',
                    title: 'Tarefa excluída com sucesso!',
                    text: 'Click no botão para prosseguir com a ação!',
                    confirmButtonText: 'OK'
                })
            }

            function buscaTabela() {
                $.ajax({
                    url: './include/consultaTabela.php',
                    type: 'post',
                    success: function (data) {
                        let tabela = $('#Table').DataTable();
                        tabela.destroy();
                        $("#listaTarefa").html('');
                        $("#listaTarefa").html(data);
                        $('#Table').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                            },
                            "order": [[0, "desc"]]
                        });
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }

            function IniciarTarefa(idtarefa, status) {
                $.ajax({
                    url: './include/statusTarefa.php',
                    type: 'post',
                    data: {
                        "idtarefa": idtarefa,
                        "status": status,
                    },
                    success: function (data) {
                        iniciaTarefa();
                        buscaTabela();
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }

            function RealizarTarefa(idtarefa, status) {
                $.ajax({
                    url: './include/statusTarefa.php',
                    type: 'post',
                    data: {
                        "idtarefa": idtarefa,
                        "status": status,
                    },
                    success: function (data) {
                        realizaTarefa();
                        buscaTabela();
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }

            function atualizaTarefa(idtarefa) {
                $('#TarefaAtualiza').modal('show');
                $.ajax({
                    url: './mAtualizaTarefa.php',
                    type: 'post',
                    data: {
                        "idtarefa": idtarefa,
                    },
                    success: function (data) {
                        $("#VerTarefa").html(data);
                        $('.select2').select2();
                        $('.date').datepicker({
                            format: "dd/mm/yyyy",
                            todayBtn: "linked",
                            forceParse: false,
                            autoclose: true,
                            todayHighlight: true,
                            language: 'pt-br',
                            zIndexOffset: 99999999,
                            orientation: 'bottom'
                        });
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('DEU RUIM');
                    }
                });
            }

            function EditaTarefaJaRealizada(idtarefa) {
                $('#tarefaJaRealizada').modal('show');
                $.ajax({
                    url: './mtarefaJaRealizada.php',
                    type: 'POST',
                    data: {
                        "idtarefa": idtarefa,
                    },
                    success: function (data) {
                        $("#realizada").html(data);
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }

            function historico() {
                $('#abrirHistorico').modal('show');
                $.ajax({
                    url: './include/tabelaHistorico.php',
                    type: 'POST',
                    success: function (data) {
                        $("#historico").html(data);
                        $('#tableHistorico').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                            },
                            "order": [[0, "desc"]]
                        });
                    },
                    error: function (xhr, er, index, anchor) {
                        $('#historico').html('Error ' + xhr.status);
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }

            function ExcluirTarefa(idtarefa) {
                $.ajax({
                    url: './include/eTarefa.php',
                    type: 'POST',
                    data: {
                        "idtarefa": idtarefa,
                    },
                    success: function (data) {
                        buscaTabela();
                        TarefaExcluida();
                    },
                    error: function (xhr, er, index, anchor) {
                        console.log(xhr.status);
                        console.log('deu RUIM');
                    }
                });
            }
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
                        <li class="breadcrumb-item"><i style="color: #4723D9; font-size: 20px; margin-right: 08px;" class="bx bx-task mt-4"></i> </li>                            
                        <li style="font-size: 14px;" class="mt-4">/ Lista de Tarefas </li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['acao']) && $_GET['msg']) {
                    echo montaAlert($_GET['acao'], $_GET['msg']);
                }
                ?>
            </main>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="clearfix middle shadow-sm bg-white p-3">
                    <button class="btn btn-primary botao my-2" data-bs-toggle="modal" data-bs-target="#tarefa">Cadastrar Tarefa</button>
                    <button class="btn btn-primary botao" data-bs-toggle="modal" data-bs-target="#tipotarefa">Cadastrar Tipos de tarefas</button>
                    <div style="float: right; cursor: pointer; font-size: 13.4px;">
                        <a onclick="historico()" ><i class="bx bx-history"></i><small>Histórico</small></a>
                    </div>
                    <h4 class="text-center my-3">Lista de Tarefas  <i class='bx bxs-receipt bx-sm'></i></h4>
                    <div class="table-responsive">
                        <table id="Table" class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th scope="row">Usuario</th>
                                    <th scope="row">Tarefa</th>
                                    <th scope="row">Data e hora agendada</th>
                                    <th scope="row">Data e hora final</th>
                                    <th scope="row">Status</th>
                                    <th scope="row">Realizar tarefa</th>
                                    <th scope="row">Editar</th>
                                </tr>
                            </thead>
                            <tbody id="listaTarefa">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include './include/modais.php';
        include './mTarefa.php';
        include './mtipotarefas.php';
        ?>
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