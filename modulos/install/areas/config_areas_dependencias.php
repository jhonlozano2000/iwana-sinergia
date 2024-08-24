    <form role="form" name="FrmDatosDependencias" id="FrmDatosDependencias">
        <div id="DivAlertaDependencias"></div>
        <div class="form-actions">
            <div class="grid-body no-border">
                <div class="row column-seperation">
                    <div class="col-md-6">
                        <div class="row form-row">
                            <div class="col-md-5">
                                <input name="cod_depen" type="text" class="form-control" id="cod_depen" placeholder="Código de la dependencia">
                            </div>
                            <div class="col-md-7">
                                <input name="cod_corres" type="text" class="form-control" id="cod_corres" placeholder="Código de correspondencia">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <input name="nom_depen" type="text" class="form-control" id="nom_depen" placeholder="Nombre de la dependencia...">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <textarea name="observa" rows="3" class="form-control" id="observa" placeholder="Observaciones si las hay..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="divDependencias" style="overflow-y: scroll; height: 20em;"></div>
                    </div>
                </div>

                <div class="pull-left">
                    <button class="btn btn-primary btn-cons" type="button" id="btnGuardarDependencia" name="btnGuardarDependencia">
                        <span class="glyphicon glyphicon-check"></span> Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>