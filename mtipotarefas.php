<!-- Modal -->
<form action="include/gtipotarefa.php" method="POST">
    <div class="modal" id="tipotarefa" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Cadastrar Tipo de tarefas <i class='bx bx-detail'></i></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <small><label class="form-label"><b style="color: red"> *</b> Tipo de tarefa</label></small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class='bx bxs-detail'></i></span>
                                <input required="" type="text" placeholder="Urgente / importante / prioridade" name="tipotarefa" class="form-control">
                            </div>
                        </div>
                    </div>
                    <p style="color: red; font-size: 12px;" class="my-1"> Obrigatório *</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class='bx bx-x-circle'></i> fechar</button>
                    <button type="submit" class="btn btn-success">Salvar <i class='bx bx-save'></i></button>
                </div>
            </div>
        </div>
    </div>
</form>