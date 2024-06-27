
<!-- BEGIN MODAL PARA MOSTRAR INFORMACION DE UN RADICADO RECIBIDO-->
<div class="modal fade" id="myModalMostrarInfoRadicadoRecibido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <span class="float-left">
                            <div id="DivOtraInfoRadicadoRecibido"></div>
                        </span>
                    </div>
                    <div class="col-md-10">
                        <i class="fa fa-file-o fa-2x text-info" style="margin-left: -200px;"></i>
                        <h4 id="myModalLabel" class="semi-bold text-info" style="margin-left: -200px;">Información del radicado:<div id="DivRadicadoRecibido" ></div></h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-01">
                    <li class="active">
                        <a href="#tabInfoRecibido">Info.</a>
                    </li>
                    <li>
                        <a href="#tabClasificaDocumentalRecibido">Clasificación</a>
                    </li>
                    <li>
                        <a href="#tabDocumentosRecibido">Docs. Asociados</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabInfoRecibido">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoRecibidoInfo"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabClasificaDocumentalRecibido">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoRecibidoClasificacion"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabDocumentosRecibido">
                        <div class="row column-seperation">
                            <div id="DivMostarDocumentosRecibido"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs btn-mini" data-dismiss="modal" id="BtnCancelarSubirDigitalRecibido">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA MOSTRAR INFORMACION DE UN RADICADO RECIBIDO -->

<!-- BEGIN MODAL PARA MOSTRAR INFORMACION DE UN RADICADO ENVIADOS-->
<div class="modal fade" id="myModalMostrarInfoRadicadoEnviado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <span class="float-left">
                            <div id="DivOtraInfoRadicadoEnviado"></div>
                        </span>
                    </div>
                    <div class="col-md-10">
                        <i class="fa fa-file-o fa-2x text-info" style="margin-left: -200px;"></i>
                        <h4 id="myModalLabel" class="semi-bold text-info" style="margin-left: -200px;">
                            Información del radicado:
                            <div id="DivRadicadoEnviado"></div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-01">
                    <li class="active">
                        <a href="#tabInfoEnviado">Info.</a>
                    </li>
                    <li>
                        <a href="#tabClasificaDocumentalEnviado">Clasificación</a>
                    </li>
                    <li>
                        <a href="#tabDocumentosEnviado">Docs. Asociados</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabInfoEnviado">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoEnviado"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabClasificaDocumentalEnviado">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoEnviadoClasificacion"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabDocumentosEnviado">
                        <div class="row column-seperation">
                            <div id="DivMostarDocumentosEnviado"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs btn-mini" data-dismiss="modal" id="BtnCancelarSubirDigitalEnviado">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA MOSTRAR INFORMACION DE UN RADICADO ENVIADOS -->

<!-- BEGIN MODAL PARA MOSTRAR INFORMACION DE UN RADICADO INTERNO-->
<div class="modal fade" id="myModalMostrarInfoRadicadoInterno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <span class="float-left">
                            <div id="DivOtraInfoRadicadoInterno"></div>
                        </span>
                    </div>
                    <div class="col-md-10">
                        <i class="fa fa-file-o fa-2x text-info" style="margin-left: -200px;"></i>
                        <h4 id="myModalLabel" class="semi-bold text-info" style="margin-left: -200px;">
                            Información del radicado:
                            <div id="DivRadicadoInterno"></div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-01">
                    <li class="active">
                        <a href="#tabInfoInterno">Info.</a>
                    </li>
                    <li>
                        <a href="#tabClasificaDocumentalInterno">Clasificación</a>
                    </li>
                    <li>
                        <a href="#tabDocumentosInterno">Docs. Asociados</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabInfoInterno">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoInterno"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabClasificaDocumentalInterno">
                        <div class="row column-seperation">
                            <div id="DivMostarInfoRadicadoInternoClasificacionDocumental"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabDocumentosInterno">
                        <div class="row column-seperation">
                            <div id="DivMostarDocumentosInterno"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs btn-mini" data-dismiss="modal" id="BtnTabRadicaInterno">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA MOSTRAR INFORMACION DE UN RADICADO INTERNO -->