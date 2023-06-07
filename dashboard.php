<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
<?php
session_start();
include './config/conexao.php';
include './config/func.php';
include './include/seguranca.php';

$hoje = date('d/m/Y');
$dataInicio = isset($_GET['inicio']) ? databanco($_GET['inicio']) : '';
$dataFim = isset($_GET['fim']) ? databanco($_GET['fim']) : '';

// TAREFAS CADASTRADAS 
$tarefasCadastradas = "SELECT 
                            count(*) 
                        FROM tarefa";
$queryTarefasCadastradas = mysqli_query($con, $tarefasCadastradas);
$rowTarefas = mysqli_fetch_array($queryTarefasCadastradas);

// TAREFAS EM ANDAMENTO
$tarefasAndamento = "select 
                        count(*) 
                    from tarefa where status = 'a'";
$queryTarefasAndamento = mysqli_query($con, $tarefasAndamento);
$rowTarefasAndamento = mysqli_fetch_array($queryTarefasAndamento);

// TAREFAS REALIZADAS
$tarefasRealizadas = "select 
                        count(*) 
                from tarefa where status = 'r'";
$queryTarefasRealizadas = mysqli_query($con, $tarefasRealizadas);
$rowTarefasRealizadas = mysqli_fetch_array($queryTarefasRealizadas);

// TAREFAS EXPIRADAS
$tarefasExpiradas = "select 
                        count(*) 
                from tarefa where status = 'e'";
$queryTarefasExpiradas = mysqli_query($con, $tarefasExpiradas);
$rowTarefasExpiradas = mysqli_fetch_array($queryTarefasExpiradas);

// CONSULTA DOS GRAFICOS
// MOSTRA TODAS AS TAREFAS CADASTRAR PARA O DIA ATUAL 
$tarefasParaOdiaAtual = "select
                            datafim,
                            count(*)
                    from tarefa where datafim = '" . dataBanco($hoje) . "'";
$queryTarefasParaHoje = mysqli_query($con, $tarefasParaOdiaAtual);
$labelTarefas = array();
$totalDeTarefas = array();
while ($rowTarefa = mysqli_fetch_array($queryTarefasParaHoje)) {
    $labelTarefas[] = dataBuscaBanco($rowTarefa[0]);
    $totalDeTarefas[] = $rowTarefa[1];
}

// GRAFICO QUANTIDADE DE USUARIOS CADASTRADOS 
$consultaTarefasUsuarios = "SELECT
                                datager,
                                count(*) 
                    FROM tarefa WHERE datager BETWEEN '$dataInicio' AND '$dataFim' group by datager";
$queryUsuarios = mysqli_query($con, $consultaTarefasUsuarios);
$labelUsuarios = array();
$rowGraficoUsuarios = array();
while ($rowGrafico = mysqli_fetch_array($queryUsuarios)) {
    $labelUsuarios[] = dataBuscaBanco(substr($rowGrafico[0], -5));
    $rowGraficoUsuarios[] = $rowGrafico[1];
}

// GRAFICO TAREFAS PENDENTES
$consultaTarefasExpiradas = "select 
                                    datager,
                                    count(*) 
                        from tarefa where datager BETWEEN '$dataInicio' AND '$dataFim' 
                        and status = 'e' group by datager";
$queryTafExpiradas = mysqli_query($con, $consultaTarefasExpiradas);
$labelExpirada = array();
$rowGraficoExpiradas = array();
while ($rowGraficoTarefasPendentes = mysqli_fetch_array($queryTafExpiradas)) {
    $labelExpirada[] = dataBuscaBanco(substr($rowGraficoTarefasPendentes[0], -5));
    $rowGraficoExpiradas[] = $rowGraficoTarefasPendentes[1];
}

// GRAFICO TAREFAS EM ANDAMENTO
$consultaTarefasAndamento = "select 
                                datager,
                                count(*) 
                        from tarefa where datager BETWEEN '$dataInicio' AND '$dataFim' and status = 'a'  group by datager";
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
                        from tarefa where datager BETWEEN '" . dataBanco($dataInicio) . "' AND '" . dataBanco($dataFim) . "' and status = 'r'  group by datager";
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
            .quantidadeDeTarefasExpiradas{
                border-color: rgb(121, 125, 127);
                color: rgb(121, 125, 127);
                stroke: rgb(121, 125, 127) !important;
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

                const totalDeTarefas = document.getElementById('totalDeTarefas');
                const tarefasDoDia = document.getElementById('tarefasDoDia');

                new Chart(totalDeTarefas, {
                    type: 'bar',
                    data: {
                        datasets: [{
                                label: 'Tarefas cadastradas',
                                data: <?= json_encode($rowGraficoUsuarios) ?>,
                                backgroundColor: [
                                    'rgba(108, 52, 131, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(118, 68, 138)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn below
                                order: 1,
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
                                order: 3,
                            }, {
                                label: 'Tarefas Expiradas',
                                data: <?= json_encode($rowGraficoExpiradas) ?>,
                                backgroundColor: [
                                    'rgb(121, 125, 127, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(121, 125, 127)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn on top
                                order: 2,
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

                new Chart(tarefasDoDia, {
                    type: 'bar',
                    data: {
                        datasets: [{
                                label: 'Tarefas cadastradas para hoje ',
                                data: <?= json_encode($totalDeTarefas) ?>,
                                backgroundColor: [
                                    'rgba(108, 52, 131, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(118, 68, 138)',
                                ],
                                borderWidth: 1,
                                type: 'bar',
                                // this dataset is drawn below
                                order: 1,
                            }],
                        labels: <?= json_encode($labelTarefas) ?>,
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

            function VerificaData() {
                let Msg = 'Limite de data indisponível , selecione no período de 30 dias';
                let button = $("#buscar");
                let datainicio = $("#dataInicio").val().split('/');
                let datafim = $("#dataFim").val().split('/');

                datainicio = new Date(datainicio[2], datainicio[1] - 1, datainicio[0]);
                datafim = new Date(datafim[2], datafim[1] - 1, datafim[0]);

                const diferenca = Math.abs(datainicio.getTime() - datafim.getTime()); // Subtrai uma data pela outra
                const dias = Math.ceil(diferenca / (1000 * 60 * 60 * 24));


                if (dias > 30) {
                    button.attr('disabled', 'disabled');
                    $("#resposta-verificacao").html(Msg);
                    $("#resposta-verificacao").show();
                } else {
                    button.removeAttr('disabled');
                    $("#resposta-verificacao").hide();
                }
            }


            function trocaBotaoBuscar() {
                $("#buscarDisabled").show();
                $("#buscar").hide()
            }
//          TEMPO DE LOADER
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

        <div class="block-header mb-0">
            <div class="row">
                <main class="breadcrumb-item active mt-3">
                    <div class="mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><i style="color: #4723D9; font-size: 20px; margin-right: 08px;" class="bx bxs-dashboard mt-4"></i> </li>                            
                            <li style="font-size: 14px;" class="mt-4">/ Dashboard </li>
                        </ul>
                        <?php
                        if (isset($_GET['acao']) && $_GET['msg']) {
                            echo montaAlert($_GET['acao'], $_GET['msg']);
                        }
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end my-3">
                            <div class="form-group"> 
                                <form action="dashboard.php" method="GET">
                                    <label class="form-label"><small><b>Período:</b></small></label>
                                    <span class="badge bg-secondary mb-2 float-end" style="color: white; text-transform: Capitalize; font-size: 13px" id="resposta-verificacao"></span>
                                    <div class="input-daterange input-group flex-nowrap " id='datepicker' data-provide="datepicker">
                                        <span class="input-group-text d-none d-sm-block" id="addon-wrapping"><i class="bx bx-calendar mt-1"></i></span>
                                        <input id="dataInicio" value="<?= dataBuscaBanco($dataInicio) ?>" placeholder="__/__/____" onchange="VerificaData()" name="inicio" type="text" class="form-control" autocomplete="off">

                                        <small class="input-group-addon range-to mx-2 mt-2"><b> até </b></small>

                                        <span class="input-group-text d-none d-sm-block" id="addon-wrapping"><i class="bx bx-calendar mt-1"></i></span>
                                        <input id="dataFim" name="fim" value="<?= dataBuscaBanco($dataFim) ?>" placeholder="__/__/____" onchange="VerificaData()" type="text" class="form-control " autocomplete="off">
                                        <button id="buscarDisabled" type="submit" style="display: none;"  disabled="disabled" class="btn btn-primary ml-2"><i style="font-size: 19px;" class="bx bx-refresh bx-spin"></i> Carregando...</button>
                                        <button id="buscar" type="submit" onclick="trocaBotaoBuscar()" class="btn btn-outline-primary ml-5"><i class='bx bx-search mr-2 mb-1'></i> Buscar </button>
                                        <a class="btn btn-outline-secondary" style="margin-left: 10px;" href="dashboard.php"><i class='bx bxs-eraser'></i> Limpar filtro</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="clearfix">
            <div class="row">
                <?php
                if (isset($_GET['inicio']) && isset($_GET['fim'])) {
                    ?>
                    <div class="col-lg-3 col-sm-12 col-md-12 mb-2">
                        <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeUsuariosCadastrados">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h6 class="mb-4">
                                            <?= $rowTarefas[0] . " Tarefas por periodo" ?>
                                        </h6>
                                        <p style="font-size: 0.9rem;" class="mb-0 cardTextColor">Total por período</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i style="font-size: 4rem;" class="bx bx-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-lg-3 col-sm-12 col-md-12 mb-2">
                        <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeUsuariosCadastrados">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h6 class="mb-4">
                                            <?= $totalDeTarefas[0] . " Tarefas para Hoje" ?>
                                        </h6>
                                        <p style="font-size: 0.9rem;" class="mb-0 cardTextColor">Tarefas para hoje </p>
                                    </div>
                                    <div class="align-self-center">
                                        <i style="font-size: 4rem;" class="bx bx-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-lg-3 col-sm-12 col-md-12 mb-2">
                    <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasExpiradas">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h6 class="mb-4">
                                        <?= $rowTarefasExpiradas[0] . " Tarefas Expiradas" ?>
                                    </h6>
                                    <p style="font-size: 0.9rem;" class="mb-0 cardTextColor">Tarefas Expiradas</p>
                                </div>
                                <div class="align-self-center">
                                    <i style="font-size: 4rem;" class='bx bx-time'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-12 mb-2">
                    <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasAndamento">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h6 class="mb-4">
                                        <?= $rowTarefasAndamento[0] . " Tarefas Em andamento" ?>
                                    </h6>
                                    <p style="font-size: 0.9rem;" class="mb-0 cardTextColor">Tarefas em andamento</p>
                                </div>
                                <div class="align-self-center">
                                    <i style="font-size: 4rem;" class="bx bx-cog bx-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-12 mb-2">
                    <div class="my-2 card rounded shadow-sm bg-white card-dashboard cardStyle quantidadeDeTarefasRealizadas">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h6 class="mb-4">
                                        <?= $rowTarefasRealizadas[0] . " Tarefas realizadas" ?>
                                    </h6>
                                    <p style="font-size: 0.9rem;" class="mb-0 cardTextColor">Tarefas realizadas</p>
                                </div>
                                <div class="align-self-center">
                                    <i style="font-size: 4rem;" class="bx bxs-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['inicio'])) {
            ?>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="clearfix middle shadow-sm bg-white rounded p-4">
                        <canvas class="chart-container" style="position: relative; height:40vh; width:80vw" id="totalDeTarefas"></canvas>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="clearfix middle shadow-sm bg-white rounded p-4">
                        <canvas class="chart-container" style="position: relative; height:40vh; width:80vw" id="tarefasDoDia"></canvas>
                    </div>
                </div>
            </div>
            <?php
        }
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
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 