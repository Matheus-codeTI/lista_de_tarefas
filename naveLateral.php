<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com-->
<body id="body-pd">
    <div class="navbar-right">
        <header class="header" class="clearfix middle shadow-sm bg-white" id="header">
            <div class="header_toggle"><i style="font-size: 25px;" class='bx bx-menu bx-x' id="header-toggle"></i></div>
            <div class="container" style="margin-left: 0;">
                <div id="navbar-search" class="d-none d-sm-block d-flex justify-content-start">
                    <?php
                    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
                    date_default_timezone_set('America/Sao_Paulo');
                    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
                    $hr = date('H:i:s', time());

                    if ($hr >= 0 && $hr < 6) {
                        $resp = "<em>Olá <b>". $_SESSION['login']."</b>, boa madrugada! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
                    } elseif ($hr >= 12 && $hr < 18) {
                        $resp = "<em>Olá <b>". $_SESSION['login']."</b>, boa tarde! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
                    } elseif ($hr >= 0 && $hr < 12) {
                        $resp = "<em>Olá <b>". $_SESSION['login']."</b>, bom dia! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
                    } else {
                        $resp = "<em>Olá <b>". $_SESSION['login']."</b>, boa noite! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
                    }
                    echo "$resp";
                    ?>
                </div>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a style="text-decoration: none" href="#" class="nav_logo"> 
                        <i class='bx bx-layer nav_logo-icon'></i>
                        <span class="nav_logo-name">Lista de Tarefas</span>
                    </a>
                    <div class="nav_list">
                        <a style="text-decoration: none" href="index.php" class="nav_link "> 
                            <i class='bx bx-calendar-check nav_icon'></i> 
                            <span class="nav_name">Cadastrar Tarefa</span>
                        </a>
                        <a style="text-decoration: none" href="dashboard.php" class="nav_link "> 
                            <i class='bx bxs-dashboard nav_icon'></i>
                            <span class="nav_name">Dashboard</span> 
                        </a>  
                        <a style="text-decoration: none" href="cadastrarLogin.php" class="nav_link "> 
                            <i class='bx bxs-user-circle nav_icon'></i>
                            <span class="nav_name">Cadastrar Login</span> 
                        </a>  
                    </div>
                </div> 
                <a href="include/logout.php" style="text-decoration: none" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> 
                    <span class="nav_name">Sair</span> 
                </a>
            </nav>
        </div>
    </div>
</body>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
