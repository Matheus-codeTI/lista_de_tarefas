<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 
<?php
include './config/conexao.php';
include './config/func.php';

$id = $_POST['idtarefa'];

$atualizaTarefa = "SELECT
                        pr.tipo,
                        taf.idtarefa, 
                        taf.usuario,
                        taf.tarefa,
                        taf.datager,
                        taf.horager,
                        taf.datafim,
                        taf.horafim,
                        taf.status
                from tarefa taf 
                inner join prioridade pr 
                on (taf.idprioridade = pr.idprioridade) where idtarefa = '$id'";
$queryAtualizaTarefa = mysqli_query($con, $atualizaTarefa);
$rowAtualizaTarefa = mysqli_fetch_array($queryAtualizaTarefa);
?>
<div class="modal-header">
    <h4 class="modal-title">#<?= ucfirst($rowAtualizaTarefa[2]) ?></h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <small><label class="form-label"><b style="color: red">*</b> Usuário:</label></small>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class='bx bxs-user'></i></span>
                <input disabled="" autocomplete="off" value="<?= $rowAtualizaTarefa[2] ?>" required="" type="text" class="form-control" name="usuario">
            </div>
        </div>
        <div class="col-md-6">
            <small><label class="form-label"><b style="color: red">*</b> tipo de tarefa:</label></small>
            <select disabled="" required="" class="form-control select2" name="tipotarefa" style="width: 100%">
                <?php
                $tipoTarefa = "select
                                    idprioridade,
                                    tipo
                            from prioridade";
                $queryTipoTarefa = mysqli_query($con, $tipoTarefa);
                while ($rowTipoTarefa = mysqli_fetch_array($queryTipoTarefa)) {
                    $selected = $rowAtualizaTarefa[0] == $rowTipoTarefa[1] ? 'selected' : '';
                    ?>
                    <option <?= $selected ?> value="<?= $rowTipoTarefa[0] ?>"><?= $rowTipoTarefa[1] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <small><label class="form-label"><span style="color: red;">*</span> Data inicio:</label></small>
            <div class="input-group date" data-provide="datepicker">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar'></i></span>
                    <input disabled="" required="" value="<?= databuscabanco($rowAtualizaTarefa[4]) ?>" type="text" autocomplete="off" class="form-control" name="datainicio">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <small><label class="form-label"><span style="color: red;">*</span> Data final:</label></small>
            <div class="input-group date" data-provide="datepicker">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar'></i></span>
                    <input disabled="" required="" type="text" autocomplete="off" value="<?= databuscabanco($rowAtualizaTarefa[6]) ?>" class="form-control" name="datafinal">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <small><label class="form-label my-2"><b style="color: red">*</b> Hora início</label></small>
            <input disabled="" required="" type="time" value="<?= $rowAtualizaTarefa[5] ?>" required="" name="horainicio" class="form-control">
        </div>
        <div class="col-md-6">
            <small><label class="form-label my-2"><b style="color: red">*</b> Hora final</label></small>
            <input disabled="" required="" type="time" value="<?= $rowAtualizaTarefa[7] ?>" name="horafinal" class="form-control">
        </div>
        <div class="col-md-12">
            <small><label class="form-label my-2"> <b style="color: red">*</b> Tarefa:</label></small>
            <textarea disabled="" name="tarefa" disabled="" class="form-control" aria-label="With textarea"><?= $rowAtualizaTarefa[3] ?></textarea>
        </div>
    </div>
    <p style="color: red; font-size: 12px;" class="my-2"> Obrigatório *</p>
</div>
<div class="modal-footer">
    <button type="button" onclick="ExcluirTarefa('<?= $rowAtualizaTarefa[1] ?>')" class="btn btn-danger" data-bs-dismiss="modal"> Excluir tarefa <i class='bx bx-trash'></i></button>
</div>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo72025@gmail.com--> 