    <div class="form-actions">
        <div class="grid-body no-border">
            <div class="row column-seperation">
                <div class="col-md-6">
                    <div class="row form-row">
                        <div class="col-md-12">
                            <select name="id_depen_oficina" id="id_depen_oficina" class="select2 form-control">
                                <option value="0">...::: Elije la Dependencia :::...</option>
                                <?php echo $Combo_Dependencias; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-row m-t-15">
                        <div class="col-md-5">
                            <input name="cod_oficina" type="text" class="form-control" id="cod_oficina"
                                placeholder="Código de la oficina">
                        </div>
                        <div class="col-md-7">
                            <input name="cod_corres_oficina" type="text" class="form-control" id="cod_corres_oficina"
                                placeholder="Código de correspondencia">
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input name="nom_oficina" type="text" class="form-control" id="nom_oficina"
                                placeholder="Nombre de la oficina">
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <textarea name="observa_oficina" rows="3" class="form-control" id="observa_oficina" placeholder="Observaciones si las hay..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="divOficinas" style="overflow-y: scroll; height: 20em;"></div>
                </div>
            </div>

            <div class="pull-left">
                <button class="btn btn-primary btn-cons" type="button" id="BtnGuardarOficina" name="BtnGuardarOficina">
                    <span class="glyphicon glyphicon-check"></span> Guardar
                </button>
            </div>
        </div>
    </div>