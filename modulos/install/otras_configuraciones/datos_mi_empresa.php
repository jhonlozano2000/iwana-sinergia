    <div class="row form-row">
        <div class="col-md-6">
            <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit">
        </div>
    </div>
    <div class="row form-row">
        <span class="col-md-12">
            <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón Social">
        </span>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="slogan" type="text" class="form-control input-sm" id="slogan" placeholder="Slogan">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-6">
            <select name="id_depar" id="id_depar" class="select2 form-control input-sm">
                <option value="0">...::: Elije el Departamento :::...</option>
                <?php echo $Combo_Departamentos; ?>
            </select>
        </div>
        <div class="col-md-6">
            <select name="id_muni" id="id_muni" class="select2 form-control input-sm">
                <option value="0">...::: Elije el Municipio :::...</option>
                <?php echo $Combo_Municipios; ?>
            </select>
        </div>
    </div>
    <div class="row form-row m-t-10">
        <div class="col-md-12">
            <input name="dir" type="text" class="form-control input-sm" id="dir" placeholder="Dirección">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-6">
            <input name="tel" type="text" class="form-control input-sm" id="tel" placeholder="Teléfonos">
        </div>
        <div class="col-md-6">
            <input name="cel" type="text" class="form-control input-sm" id="cel" placeholder="Celular">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="email" type="text" class="form-control input-sm" id="email" placeholder="E-Mail">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="web" type="text" class="form-control input-sm" id="web" placeholder="Web">
        </div>
    </div>