<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php
include './config/conexao.php';
include './config/func.php';

$id = (int) $_POST['idlogin'];

$buscaUsuario = " Select
                        idlogin,
                        login
                from login where idlogin = $id";
$queryBuscaUsuario = mysqli_query($con, $buscaUsuario);
$rowUsuarioBuscado = mysqli_fetch_array($queryBuscaUsuario);
?>
<div class="modal-body">
    <div class='border rounded p-3 mb-3'>
        <h5 class='text-secondary text-center'>
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <b>O usuário</b> <?= ucfirst($rowUsuarioBuscado[1]) ?> <b> será deletado </b>.
        </h5>
    </div>
    <h5 class="text-center pb-1">
        Deseja continuar?
    </h5>
    <div class='d-flex justify-content-between mb-2'>
        <button type="button" class="btn btn-danger mr-4" data-bs-dismiss="modal">
            <i class='bx bx-x-circle'></i> Não
        </button>
        <a href='include/eExcluiUsuario.php?idlogin=<?= $rowUsuarioBuscado[0] ?>' class="btn btn-success text-white">
            <i class='bx bx-check-circle'></i> Sim
        </a>
    </div>
</div>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 