<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 
<?php
include './config/conexao.php';
include './config/func.php';

$id = $_POST['idlogin'];

$atualizaUsuario = " Select
                          idlogin,
                          login,
                          status
                    from login where idlogin = $id";
$queryUsuarios = mysqli_query($con, $atualizaUsuario);
$rowUsuarios = mysqli_fetch_array($queryUsuarios);
?>
<form method="POST" action="include/atualizaLogin.php?idlogin=<?= $rowUsuarios[0] ?>">
    <div class="modal-header">
        <h5 class="modal-title">#<?= ucfirst($rowUsuarios[1]) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <label class="form-label"><i class='bx bxs-user-circle'></i> Login: <span style="color: red">*</span></label>
                <input required autocomplete="off" class="form-control" value="<?= $rowUsuarios[1] ?>" name="login" type="text" >
            </div>
            <div class="col-lg-6">
                <label class="form-label mt-2"><i class='bx bxs-user-circle'></i> Status: <span style="color: red">*</span></label>
                <select class="form-control select2" name="status" style="width: 100%">
                    <option value="a" <?= $rowUsuarios[2] == 'a' ? 'selected' : '' ?>>Ativo</option>
                    <option value="i" <?= $rowUsuarios[2] == 'i' ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>
            <div class="col-md-12 mt-1">
                <small style="color: red"> * obrigatório </small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class='bx bx-x-circle'></i> Fechar</button>
        <button type="submit" class="btn btn-success">Salvar <i class='bx bx-save'></i></button>
    </div>
</form>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 