<?php
include './config/conexao.php';
include './config/func.php';
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
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(() => {
                    document.getElementById('pagina').style.display = 'none';
                }, 300);
            });
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                defaultDate: '2018-11-16',
                navLinks: true,
                eventLimit: true,
                events: [{
                        title: 'Front-End Conference',
                        start: '2018-11-16',
                        end: '2018-11-18'
                    },
                    {
                        title: 'Hair stylist with Mike',
                        start: '2018-11-20',
                        allDay: true
                    },
                    {
                        title: 'Car mechanic',
                        start: '2018-11-14T09:00:00',
                        end: '2018-11-14T11:00:00'
                    },
                    {
                        title: 'Dinner with Mike',
                        start: '2018-11-21T19:00:00',
                        end: '2018-11-21T22:00:00'
                    },
                    {
                        title: 'Chillout',
                        start: '2018-11-15',
                        allDay: true
                    },
                    {
                        title: 'Vacation',
                        start: '2018-11-23',
                        end: '2018-11-29'
                    },
                ]
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
                        <li class="breadcrumb-item"><i style="color: green; font-size: 20px; margin-right: 08px;" class="bx bxs-calendar mt-4"></i> </li>                            
                        <li style="font-size: 14px;" class="mt-4">/ Agenda </li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['acao']) && $_GET['msg']) {
                    echo montaAlert($_GET['acao'], $_GET['msg']);
                }
                ?>
            </main>
            <div id="calendar">

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
        <!--date picker-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--SWEETALERT2-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--SCRIPT--> 
        <script src="script/javascript.js"></script>
    </body>
</html>