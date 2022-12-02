<?php
include './config/conexao.php';
include './config/func.php';

// USUARIOS CADASTRADOS 
$usuariosCadastrados = "SELECT count(*) FROM tarefa";
$queryTarefa = mysqli_query($con, $usuariosCadastrados);
$rowUsuarios = mysqli_fetch_array($queryTarefa);

// TAREFAS EM ANDAMENTO
$tarefasAndamento = "select count(*) from tarefa where status = 'a'";
$queryTarefasAndamento = mysqli_query($con, $tarefasAndamento);
$rowTarefasAndamento = mysqli_fetch_array($queryTarefasAndamento);

// TAREFAS REALIZADAS
$tarefasRealizadas = "select count(*) from tarefa where status = 'r'";
$queryTarefasRealizadas = mysqli_query($con, $tarefasRealizadas);
$rowTarefasRealizadas = mysqli_fetch_array($queryTarefasRealizadas);

//TAREFAS PENDENTES
$tarefasPendentes = "select count(*) from tarefa where status = 'p'";
$queryTarefasPendentes = mysqli_query($con, $tarefasPendentes);
$rowTarefasPendentes = mysqli_fetch_array($queryTarefasPendentes);

// CONSULTA DO GRAFICO / BAR
// GRAFICO QUANTIDADE DE USUARIOS CADASTRADOS 
$consultaTarefasUsuarios = "SELECT
                                datager,
                                count(*) 
                        FROM tarefa";
$queryUsuarios = mysqli_query($con, $consultaTarefasUsuarios);
$labelUsuarios = array();
$rowGraficoUsuarios = array();
while ($rowGrafico = mysqli_fetch_array($queryUsuarios)) {
    $labelUsuarios[] = dataBuscaBanco(substr($rowGrafico[0], -5));
    $rowGraficoUsuarios[] = $rowGrafico[1];
}

// GRAFICO TAREFAS PENDENTES
$consultaTarefasPendentes = "select 
                                datager,
                                count(*) 
                        from tarefa where status = 'p'";
$queryTafPendentes = mysqli_query($con, $consultaTarefasPendentes);
$labelPendentes = array();
$rowGraficoPendentes = array();
while ($rowGraficoTarefasPendentes = mysqli_fetch_array($queryTafPendentes)) {
    $labelPendentes[] = dataBuscaBanco(substr($rowGraficoTarefasPendentes[0], -5));
    $rowGraficoPendentes[] = $rowGraficoTarefasPendentes[1];
}

// GRAFICO TAREFAS EM ANDAMENTO
$consultaTarefasAndamento = "select 
                                datager,
                                count(*) 
                        from tarefa where status = 'a'";
$queryTafAndamento = mysqli_query($con, $consultaTarefasAndamento);
$labelAndamento = array();
$rowGraficoAndamento = array();
while ($rowGraficoTarefasAndamento = mysqli_fetch_array($queryTafAndamento)) {
    $labelAndamento[] = dataBuscaBanco(substr($rowGraficoTarefasAndamento[0], -5));
    $rowGraficoAndamento[] = $rowGraficoTarefasAndamento[1];
}


// GRAFICO DE TAREDAS REALIZADAS
$consultaTarefasRealizadas = "select 
                                datager,
                                count(*) 
                        from tarefa where status = 'r'";
$queryTafRealizadas = mysqli_query($con, $consultaTarefasRealizadas);
$labelRealizadas = array();
$rowGraficoRealizada = array();
while ($rowGraficoTarefasRealizadas = mysqli_fetch_array($queryTafRealizadas)) {
    $labelRealizadas[] = dataBuscaBanco(substr($rowGraficoTarefasRealizadas[0], -5));
    $rowGraficoRealizada[] = $rowGraficoTarefasRealizadas[1];
}
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
            }
            .c3-event-rect{
                display: none;
            }
            .cardStyle{
                border-radius: 10px !important;
                border: none;
                border-left: 8px solid #ccc;
                transition:250ms
            }
            .cardStyle:hover{
                transform: translateY(-5px);
            }
            /* COR DO CARD */
            .quantidadeDeUsuariosCadastrados{
                border-color: rgb(155, 89, 182);
                color: rgb(155, 89, 182);
                stroke: rgb(155, 89, 182) !important;
            }
            .quantidadeDeTarefasAndamento{
                border-color: rgb(52, 152, 219);
                color: rgb(52, 152, 219);
                stroke: rgb(52, 152, 219) !important;
            }
            .quantidadeDeTarefasRealizadas{
                border-color: rgb(88, 214, 141 );
                color: rgb(88, 214, 141 );
                stroke: rgb(88, 214, 141 ) !important;
            }
            .quantidadeDeTarefasPendentes{
                border-color: rgb(241, 196, 15 );
                color: rgb(241, 196, 15 );
                stroke: rgb(241, 196, 15 ) !important;
            }
            .quantidadeDeUsuarios{
                border-color: #5DADE2;
                color: #5DADE2;
                stroke: #5DADE2 !important;
            }
            .cardTextColor{
                color: #656565;
            }
            .ct-series-a .ct-line, .ct-series-a .ct-bar, .ct-series-a .ct-point {
                stroke: #f9ab6c;
            }
            *::-webkit-scrollbar{
                width: 0;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(() => {
                    document.getElementById('pagina').style.display = 'none';
                }, 300);


                const ctx = document.getElementById('grafico');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: [{
                                label: 'Usuários cadastrados',
                                data: <?= json_encode($rowGraficoUsuarios) ?>,
                                backgroundColor: [
                                    'rgba(118, 68, 138, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(118, 68, 138)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn below
                                order: 1
                            }, {
                                label: 'Tarefas Pendentes',
                                data: <?= json_encode($rowGraficoPendentes) ?>,
                                backgroundColor: [
                                    'rgba(183, 149, 11, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(183, 149, 11)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn on top
                                order: 2
                            }, {
                                label: 'Tarefas em Andamento',
                                data: <?= json_encode($rowGraficoAndamento) ?>,
                                backgroundColor: [
                                    'rgba(40, 116, 166, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(40, 116, 166)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn on top
                                order: 3
                            }, {
                                label: 'Tarefas realizadas',
                                data: <?= json_encode($rowGraficoRealizada) ?>,
                                backgroundColor: [
                                    'rgba(29, 131, 72, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(29, 131, 72)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn on top
                                order: 4
                            }],
                        labels: <?= json_encode($labelUsuarios) ?>,
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
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
                        <li class="breadcrumb-item"><i style="color: green; font-size: 20px; margin-right: 08px;" class="bx bxs-dashboard mt-4"></i> </li>                            
                        <li style="font-size: 14px;" class="mt-4">/ Dashboard </li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['acao']) && $_GET['msg']) {
                    echo montaAlert($_GET['acao'], $_GET['msg']);
                }
                ?>
            </main>
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasAndamento">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h4 class="mb-4">
                                    <?= $rowTarefasAndamento[0] . " Tarefas em andamento" ?>
                                </h4>
                                <p style="font-size: 1.2rem;" class="mb-0 cardTextColor"> Tarefas em andamento</p>
                            </div>
                            <div class="align-self-center">
                                <i style="font-size: 5rem;" class="bx bx-cog"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasPendentes">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h4 class="mb-4">
                                    <?= $rowTarefasPendentes[0] . " tarefas pendentes" ?>
                                </h4>
                                <p style="font-size: 1.2rem;" class="mb-0 cardTextColor">Numero de tarefas Pendentes</p>
                            </div>
                            <div class="align-self-center">
                                <i style="font-size: 5rem;" class="bx bx-calendar-x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasRealizadas">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h4 class="mb-4">
                                    <?= $rowTarefasRealizadas[0] . " tarefas realizadas" ?>
                                </h4>
                                <p style="font-size: 1.2rem;" class="mb-0 cardTextColor"> Número de tarefas realizadas</p>
                            </div>
                            <div class="align-self-center">
                                <i style="font-size: 5rem;" class="bx bxs-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="clearfix middle shadow-sm bg-white rounded p-4">
                    <canvas class="chart-container" style="position: relative; height:40vh; width:80vw" id="grafico"></canvas>
                </div>
            </div>
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
        <!--GRAFICO-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!--date picker-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--SWEETALERT2-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--SCRIPT--> 
        <script src="script/javascript.js"></script>
    </body>
</html>