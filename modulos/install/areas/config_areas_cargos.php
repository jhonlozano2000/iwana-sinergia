<div class="form-actions">
    <div class="grid-body no-border">
        <div class="row column-seperation">
            <div class="col-md-6">
                <div class="row form-row">
                    <div class="col-md-5">
                        <select name="id_depen" id="id_depen" class="select2 form-control">
                            <option value="0">...::: Elije la Dependencia :::...</option>
                            <?php echo $Combo_Dependencias; ?>
                        </select>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12">
                        <input name="nom_cargo" type="text" class="form-control" id="nom_cargo"
                            placeholder="Nombre del cargo">
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12">
                        <textarea name="observa" rows="3" class="form-control" id="observa" placeholder="Observaciones si las hay...">
                                                </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>

        <div class="pull-left">
            <button class="btn btn-primary btn-cons" type="button" id="BtnGuardar" name="BtnGuardar">
                <span class="glyphicon glyphicon-check"></span> Guardar
            </button>
            <button class="btn btn-white btn-cons" type="button" id="BtnRegresar" name="BtnRegresar">
                <span class="fa fa-mail-reply-all"></span> Regresar
            </button>
        </div>
    </div>
</div>