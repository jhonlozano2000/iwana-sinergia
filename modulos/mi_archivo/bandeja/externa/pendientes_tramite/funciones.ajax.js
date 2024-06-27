$(document).ready(function () {
    $(document).on("click", "#BtnDescargaPlantilla", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var IdDepen = $(this).data("id_depen");
        var Responsable = $(this).data("responsable");
        var PlantillaGenerada = $(this).data("plantillta_generada");
        var NombrePlantilla = $(this).data("plantillta_nombre");
        var IdRuta = $(this).data("id_ruta");

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=DESCARGAR_PLANTILLA&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta + "IdDepen=" + IdDepen + "&Responsable=" + Responsable + "&PlantillaGenerada=" + PlantillaGenerada + "id_ruta=" + IdRuta,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
            },
            success: function (msj) {
                var Elementos = msj.split("#**#");

                if (Elementos[0] == 1) {
                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se descargo correctamente.</div>');
                    window.open("../../../../varios/generar_plantilla.php?id_temp=" + Elementos[1] + "&Ciudad=" + Elementos[2] + "&Status=" + Elementos[3] + "&DestinaContacto=" + Elementos[4] + "&DestinaCargo=" + Elementos[5] + "&DestinaRazonSocial=" + Elementos[6] + "&DestinaDireccion=" + Elementos[7] + "&DestinaDomicilio=" + Elementos[8] + "&Asunto=" + Elementos[9] + "&Saludo=" + Elementos[10] + "&Despedida=" + Elementos[11] + "&RemiteNombre=" + Elementos[12] + "&RemiteCargo=" + Elementos[13] + "&Proyector=" + Elementos[14], "_blank");
                } else if (msj == 2) {
                    $.ajax({
                        url: "../../../../varios/ftp.acciones.php",
                        type: "POST",
                        data: "accion=PLANTILLA_DESCARGAR&id_radicado=" + IdTemp + "&NombrePlantilla=" + NombrePlantilla + "&id_ruta=" + IdRuta,
                        beforeSend: function () {
                            $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                        },
                        success: function (msj) {
                            $("#DivAlertas").empty();
                            if (msj == 1) {
                                url = "../../../../../archivos/temp/planillas_temporales/" + NombrePlantilla;
                                window.open(url, "Download");
                            } else {
                                sweetAlert("Oops...", msj, "error");
                            }
                        },
                        error: function (error) {
                            sweetAlert("Oops...", error, "error");
                        },
                    });
                } else {
                    $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });
    });

    $(document).on("click", "#TipoVer", function (event) {
        $("#tipo_ver").val($(this).data("tipo_ver"));
        load(1);
    });

    //FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on("click", "#BtnMostarInfoRadicadoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $("#DivRadicadoRecibido").html(IdRadicado);

        $.ajax({
            url: "../../../../ventanilla/varios/tab_radicado_recibido_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoInfo").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../../../ventanilla/varios/tab_radicado_recibido_clasificacion.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoClasificacion").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../../../ventanilla/varios/tab_radicado_recibido_documentos.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarDocumentosRecibido").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../../../ventanilla/varios/tab_radicado_recibido_otra_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivOtraInfoRadicadoRecibido").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnResponderCorrespondencia", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        window.location = "../responder/index.php?id_radica=" + IdRadicado;
    });

    $(document).on("click", "#BtnCargarPlantilla", function (e) {
        $("#id_temp").val($(this).data("id_temp"));
        $("#plantillta_generada").val($(this).data("plantillta_generada"));
        $("#reponsable").val($(this).data("responsable"));
    });

    $("#BtnSubirPlantilla").click(function () {
        if ($("#file").val() == "") {
            $("#DivAlertarAdjuntoDigital").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el archivo a subir.</div>');
        } else {
            var formData = new FormData($(".formulario")[0]);

            $.ajax({
                url: "../../../../varios/ftp.acciones.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Subiendo el archivo, por favor espere. </div>');
                },
                success: function (msj) {
                    $("#DivAlertarAdjuntoDigital").empty();

                    var Elementos = msj.split("-");
                    if (Elementos[0] == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se subio correctamente.</div>');
                        $("#myModalAdjuntarDocumento").modal("hide");

                        $.ajax({
                            url: "acciones.ajax.php",
                            type: "POST",
                            data: "accion=SUBIR_PLANTILLA&IdTemp=" + $("#id_temp").val() + "&PlantillaNombre=" + $("#archivo").val() + "&Responsable=" + $("#reponsable").val() + "&id_ruta=" + Elementos[1],
                            beforeSend: function () {
                                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="20" height="20" /> Estableciendo criterios, por favor espere...</div>');
                            },
                            success: function (msj) {
                                $("#DivAlertas").empty();
                                $("#BtnCancelarCargarDigital").click();

                                if (msj == 1) {
                                }
                            },
                            error: function (msj) {
                                $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                            },
                        });
                    } else {
                        sweetAlert("Oops...", msj, "error");
                    }
                },
                warning: function () {
                    sweetAlert("Oops...", msj, "error");
                },
            });
        }
    });

    $(document).on("click", "#BtnAprobar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=APROBAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
            },
            success: function (msj) {
                if ((msj = 1)) {
                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                } else {
                    $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });
    });

    $(document).on("click", "#BtnNotas", function (e) {
        $("#id_temp").val($(this).data("id_temp"));

        var IdTemp = $(this).data("id_temp");

        $.post(
            "../../../../varios/combo_responsables_proyectores.php",
            {
                IdTemp: IdTemp,
            },
            function (data) {
                $("#id_destina").html(data);
            }
        );
    });

    $(document).on("click", "#BtnGuardarNota", function (e) {
        $.ajax({
            url: "acciones_notas.ajax.php",
            type: "POST",
            data: "accion=GUARDAR_NOTA&IdTemp=" + $("#id_temp").val() + "&IdFuncioDestino=" + $("#id_destina").val() + "&nota=" + $("#nota").val(),
            beforeSend: function () {
                $("#DivAlertasNotas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
            },
            success: function (msj) {
                alert(msj);

                if ((msj = 1)) {
                    $("#DivAlertasNotas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                } else {
                    $("#DivAlertasNotas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertasNotas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });
    });

    $(document).on("click", "#BtnDelegarGrupoColaborativo", function (e) {
        $("#id_radica").val($(this).data("id_radicado"));
    });

    $(document).on("click", "#BtnAsignarFuncionarioParCrearGrupoColaborativo", function (event) {
        var Funcionario = $(this).data("funcion");

        $("#DivTituloGrupoColaborativo").val(Funcionario);
        $("#id_funcio_deta").val($(this).data("id_funcio_deta"));
    });

    $(document).on("click", "#BtnGuardarGrupoColaborativo", function (event) {
        var IdFuncioDetaAsignado = $(this).data("id_funcio_deta");
        var IdRadica = $("#id_radica").val();
        var Funcionario = $(this).data("funcion");
        var IdFuncioDeta = $("#id_funcio_deta").val();

        $("#DivTituloGrupoColaborativo").val(Funcionario);

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=ASIGNAR_FUNCIONARIO_PARA_CREAR_GRUPO_COLABORATIVO&id_radica=" + IdRadica + "&IdFuncioDeta=" + IdFuncioDeta + "&observa_grupo_colaborativo=" + $("#observa_grupo_colaborativo").val(),
            beforeSend: function () {
                $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                    swal("¡Asingnación de la creacion de grupo colaborativo!.", "La asingnación de la creacion del grupo colaborativo a el funcionario " + Funcionario + " ha sido exítosa");
                } else {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    swal("¡Asingnación de la creacion de grupo colaborativo!.", msj);
                }

                $("#BtnCerrarGrupoColaborativo").click();
                $("#BtnCerrarModalFuncionarios").click();
            },
            error: function (msj) {
                $("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnPase", function (event) {
        $("#id_radica").val($(this).data("id_radicado"));
    });

    $(document).on("click", "#BtnRealizarPase", function (event) {
        var IdFuncioDestino = $(this).data("id_funcio_deta");
        var IdRadica = $("#id_radica").val();
        Funcionario = $(this).data("funcionario");

        swal(
            {
                title: "Realizar pase",
                text: "¿Desea pasar el radicado al funcionario: " + Funcionario + "?",
                type: "success",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#468847",
                confirmButtonText: "¡si, pasar!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "../recibidas/acciones.ajax.php",
                    type: "POST",
                    data: "accion=PASAR&id_radica=" + IdRadica + "&id_funcio=" + IdFuncioDestino,
                    beforeSend: function () {
                        $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                            swal("¡Pase!.", "Le pase al funcionario " + Funcionario + " ha sido exítosa");

                            $("#TRRadicado" + IdRadica).remove();
                        } else {
                            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                            swal("¡Asingnación de la creacion de grupo colaborativo!.", msj);
                        }

                        $("#BtnCerrarModalFuncionarios").click();
                    },
                    error: function (msj) {
                        $("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        );
    });

    $(document).on("click", "#BtnHispotialPase", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $.ajax({
            url: "../recibidas/listar_historial_pase.php",
            type: "POST",
            data: "id_radicado=" + IdRadicado,
            beforeSend: function () {
                $("#DivListarHistoriaPase").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#DivListarHistoriaPase").html(msj);
            },
            error: function (msj) {
                $("#DivListarHistoriaPase").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnDescargarArchivoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        var Archivo = $(this).data("archivo");
        var IdRuta = $(this).data("id_ruta");

        if (IdRuta == 0) {
            sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
        } else {
            $.ajax({
                url: "../../../../varios/ftp.acciones.php",
                type: "POST",
                data: "accion=RECIBIDOS_DESCARGAR&id_radicado=" + IdRadicado + "&id_ruta=" + IdRuta,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                },
                success: function (msj) {
                    $("#DivAlertas").empty();
                    if (msj == 1) {
                        window.open("../../../../../archivos/temp/recibidos/" + Archivo, "_blank");
                    } else {
                        sweetAlert("Oops...", msj, "warning");
                    }
                },
                error: function (error) {
                    sweetAlert("Oops...", error, "error");
                },
            });
        }
    });
});
