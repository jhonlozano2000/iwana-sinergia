    <div class="form-actions">
        <div class="grid-body no-border">
            <div class="row column-seperation">
                <div class="col-md-12">
                    <div class="row column-seperation">
                        <div class="col-md-6">
                            <h4><span class="text-success">Nueva, </span>Información básica del funcionario</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <input name="cod_funcio" type="text" class="form-control" id="cod_funcio" placeholder="# De Documento">
                                </div>
                                <div class="col-md-4">
                                    <select name="genero" id="genero" class="select2 form-control">
                                        <option value="0">...::: Elije el Sexo :::...</option>
                                        <option value="M" selected="">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <input name="nom_funcio" type="text" class="form-control" id="nom_funcio" placeholder="Nombre del funcionario">
                                </div>
                                <div class="col-md-6">
                                    <input name="ape_funcio" type="text" class="form-control" id="ape_funcio" placeholder="Apellidos del funcionario">
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <select name="id_depar" id="id_depar" class="select2 form-control">
                                        <option value="0">...::: Elije el Departamento :::...</option>
                                        <?php echo $Combo_Departamentos; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="id_muni" id="id_muni" class="select2 form-control">
                                        <option value="0">...::: Elije el Municipio :::...</option>
                                        <?php echo $Combo_Municipios; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-row m-t-15">
                                <div class="col-md-12">
                                    <input name="dir" type="text" class="form-control" id="dir" placeholder="Dirección del funcionario">
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <input name="tel" type="text" class="form-control" id="tel" placeholder="Teléfono del funcionario">
                                </div>
                                <div class="col-md-6">
                                    <input name="cel" type="text" class="form-control" id="cel" placeholder="Celular del funcionario">
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail del uncionario">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4><span class="text-success">Ubicación</span> Dentro De La Institución</h4>
                            <div class="col-md-12">
                                <select name="id_depen_funcio" id="id_depen_funcio" class="select2 form-control">
                                    <option value="0">...::: Elije la Dependencia :::...</option>
                                    <?php echo $Combo_Dependencias; ?>
                                </select>
                            </div>
                            <div class="col-md-12 m-t-15">
                                <select name="id_oficina_funcio" id="id_oficina_funcio" class="select2 form-control">
                                    <option value="0">...::: Elije la Oficina :::...</option>
                                    <?php echo $Combo_Oficinas; ?>
                                </select>
                            </div>
                            <div class="col-md-12 m-t-15">
                                <select name="id_cargo_funcio" id="id_cargo_funcio" class="select2 form-control">
                                    <option value="0">...::: Elije la Cargo :::...</option>
                                    <?php echo $Combo_Cargos; ?>
                                </select>
                            </div>
                            <h4 class="m-t-25"><span class="text-success m-t-25">Permisos</span></h4>
                            <div class="col-md-12">
                                <div class="checkbox check-success  ">
                                    <input name="jefe_dependencia" type="checkbox" id="jefe_dependencia">
                                    <label for="jefe_dependencia">Jefe de Dependencia</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <span class="help">e.g. "25/12/2013"</span>
                                <div class="controls">
                                    <input type="text" class="form-control" id="date">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkbox check-success  ">
                                    <input name="propie_princi" type="checkbox" id="propie_princi">
                                    <label class="form-label tip" for="propie_princi" data-toggle="tooltip" title="" data-placement="right" data-original-title="Permite detener el flujo de la correspondencia hasta que este usuario desbloque un radicado o haga un pase de la comunicación">Propietario principal</label>
                                    <span class="help tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Permite detener el flujo de la correspondencia hasta que este usuario desbloque un radicado o haga un pase de la comunicación">Help</span>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="checkbox check-success  ">
                                    <input name="crea_expedien" type="checkbox" id="crea_expedien">
                                    <label for="crea_expedien">Crear Expediente</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox check-success  ">
                                    <input name="jefe_oficina" type="checkbox" id="jefe_oficina">
                                    <label for="jefe_oficina">Jefe de Oficina</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox check-success  ">
                                    <input name="puede_firmar" type="checkbox" id="puede_firmar">
                                    <label for="puede_firmar">Puede Firmar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>

            <div class="pull-left">
                <button class="btn btn-primary btn-cons" type="button" id="BtnGuardarFuncionario" name="BtnGuardarFuncionario">
                    <span class="glyphicon glyphicon-check"></span> Guardar
                </button>
            </div>
        </div>
    </div>