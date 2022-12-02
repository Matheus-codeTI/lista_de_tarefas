<div class="navbar-right">
    <header class="header" class="clearfix middle shadow-sm bg-white" id="header">
        <div class="header_toggle"><i style="font-size: 25px;" class='bx bx-menu bx-x' id="header-toggle"></i></div>
        <div id="navbar-search" class="d-none d-sm-block d-flex justify-content-start">
            <?php
            $hr = date("H:i:s");
            if ($hr >= 12 && $hr < 18) {
                $resp = "<em>Olá , bom dia! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
            } else if ($hr >= 0 && $hr < 12) {
                $resp = "<em>Olá , bom noite! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
            } else {
                $resp = "<em>Olá , bom tarde! Bem vindo(a) a sua <b>lista de tarefa!</b></em>";
            }
            echo "$resp";
            ?>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a style="text-decoration: none" href="#" class="nav_logo"> 
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">BBBootstrap</span>
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
                </div>
            </div> 
            <a style="text-decoration: none" href="#" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="nav_name">SignOut</span> 
            </a>
        </nav>
    </div>
</div>
