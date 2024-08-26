<div class="form-actions">
    <div class="grid-body no-border">
        <div class="row column-seperation">
            <div class="col-md-6">
                <div class="row form-row">
                    <div class="col-md-12">
                        <select name="id_depen_cargos" id="id_depen_cargos" class="select2 form-control">
                            <option value="0">...::: Elije la Dependencia :::...</option>
                            <?php echo $Combo_Dependencias; ?>
                        </select>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12 m-t-15">
                        <input name="nom_cargo" type="text" class="form-control" id="nom_cargo"
                            placeholder="Nombre del cargo">
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12">
                        <textarea name="observa_cargos" rows="3" class="form-control" id="observa_cargos" placeholder="Observaciones si las hay..."></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="divCargos" style="overflow-y: scroll; height: 20em;"></div>
            </div>
        </div>

        <div class="pull-left">
            <button class="btn btn-primary btn-cons" type="button" id="BtnGuardarCargos" name="BtnGuardarCargos">
                <span class="glyphicon glyphicon-check"></span> Guardar
            </button>
        </div>
    </div>
</div>