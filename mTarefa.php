<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 

<!-- Modal -->
<form action="include/gtarefa.php" method="POST">
    <div class="modal" id="tarefa" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar tarefa <i class='bx bx-calendar-edit'></i></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label"><b style="color: red">*</b> Usuário:</label></small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class='bx bxs-user'></i></span>
                                <input autocomplete="off" required="" type="text" class="form-control" name="usuario">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label"><b style="color: red">*</b> tipo de tarefa:</label></small>
                            <select required="" class="form-control select2" name="tipotarefa" style="width: 100%">
                                <?php
                                $tipoTarefa = "select
                                                    idprioridade,
                                                    tipo
                                            from prioridade";
                                $queryTipoTarefa = mysqli_query($con, $tipoTarefa);
                                while ($rowTipoTarefa = mysqli_fetch_array($queryTipoTarefa)) {
                                    ?>
                                    <option value="<?= $rowTipoTarefa[0] ?>"><?= $rowTipoTarefa[1] ?></option> 
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label my-2"><span style="color: red;">*</span> Data inicio:</label></small>
                            <div class="input-group date" data-provide="datepicker">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar'></i></span>
                                    <input required="" type="text" autocomplete="off" placeholder="<?= $hoje ?>" class="form-control" name="datainicio">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label my-2"><span style="color: red;">*</span> Data final:</label></small>
                            <div class="input-group date" data-provide="datepicker">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar'></i></span>
                                    <input required="" type="text" id="DataFin" autocomplete="off" placeholder="<?= $hoje ?>" class="form-control" name="datafinal">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label my-2"><b style="color: red">*</b> Hora início</label></small>
                            <input required="" id="HoraInicio" type="time" required="" name="horainicio" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <small><label class="form-label my-2"><b style="color: red">*</b> Hora final</label></small>
                            <input required="" onchange="VerificaHoraFinal()"  id="HoraFinal" type="time" name="horafinal" class="form-control">
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <small><label class="form-label my-2"> <b style="color: red">*</b> Tarefa:</label></small>
                            <textarea name="tarefa" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <p style="color: red; font-size: 12px;" class="my-2"> Obrigatório *</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class='bx bx-x-circle'></i> fechar</button>
                    <button type="submit" id="CadastrarTarefa" class="btn btn-success">Salvar <i class='bx bx-save'></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--DESENVOLVIDO POR MATHEUS ARAUJO DOS SANTOS--> 
<!--EMAIL : matheusaraujo7562@gmail.com--> 