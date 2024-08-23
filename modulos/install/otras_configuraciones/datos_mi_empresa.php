    <div class="row form-row">
        <div class="col-md-6">
            <input name="nit" type="text" class="form-control" id="nit" placeholder="Nit" value="1">
        </div>
    </div>
    <div class="row form-row">
        <span class="col-md-12">
            <input name="razo_soci" type="text" class="form-control" id="razo_soci" placeholder="Razón Social" value="1">
        </span>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="slogan" type="text" class="form-control" id="slogan" placeholder="Slogan" value="1">
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
            </select>
        </div>
    </div>
    <div class="row form-row m-t-10">
        <div class="col-md-12">
            <input name="dir" type="text" class="form-control" id="dir" placeholder="Dirección" value="1">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-6">
            <input name="tel" type="text" class="form-control" id="tel" placeholder="Teléfonos" value="1">
        </div>
        <div class="col-md-6">
            <input name="cel" type="text" class="form-control" id="cel" placeholder="Celular" value="1">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail" value="1@a.com">
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-12">
            <input name="web" type="text" class="form-control" id="web" placeholder="Web">
        </div>
    </div>