$(document).ready(function () {
    $(document).on("click", "#BtnDescargaPlantilla", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var IdDepen = $(this).data("id_depen");
        var Responsable = $(this).data("responsable");
        var TipoFuncionario = $(this).data("tipo_funcionario");
        var PlantillaGenerada = $(this).data("plantillta_generada");
        var PlantillaCargada = $(this).data("plantillta_cargada");
        var NombrePlantilla = $(this).data("plantillta_nombre");
        var IdRuta = $(this).data("id_ruta");

        Descargar_Plantilla(IdTemp, IdFuncioDeta, IdDepen, Responsable, TipoFuncionario, PlantillaGenerada, PlantillaCargada, NombrePlantilla, IdRuta);

        load(1);
    });

    function Descargar_Plantilla(IdTemp, IdFuncioDeta, IdDepen, Responsable, TipoFuncionario, PlantillaGenerada, PlantillaCargada, NombrePlantilla, IdRuta) {
        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=DESCARGAR_PLANTILLA&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta + "IdDepen=" + IdDepen + "&Responsable=" + Responsable + "&tipo_funcionario=" + TipoFuncionario + "&PlantillaGenerada=" + PlantillaGenerada + "&PlantillaCargada=" + PlantillaCargada + "&id_ruta=" + IdRuta,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
            },
            success: function (msj) {
                var Elementos = msj.split("******");

                if (Elementos[0] == 1) {
                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se descargo correctamente.</div>');
                    window.open("../../../../varios/generar_plantilla.php?id_temp=" + Elementos[1] + "&Ciudad=" + Elementos[2] + "&Status=" + Elementos[3] + "&DestinaContacto=" + Elementos[4] + "&DestinaCargo=" + Elementos[5] + "&DestinaRazonSocial=" + Elementos[6] + "&DestinaDireccion=" + Elementos[7] + "&DestinaDomicilio=" + Elementos[8] + "&Asunto=" + Elementos[9] + "&Saludo=" + Elementos[10] + "&Despedida=" + Elementos[11] + "&QuienesFirman=" + Elementos[12] + "&Anexos=" + Elementos[13] + "&Con_Copia=" + Elementos[14] + "&Aprobado_Por=" + Elementos[15] + "&Proyector=" + Elementos[16] + "&Clasificacion_Documental=" + Elementos[17], "_blank");
                } else if (msj == 2) {
                    $.ajax({
                        url: "../../../../varios/ftp.acciones.php",
                        type: "POST",
                        data: "accion=PLANTILLA_DESCARGAR&id_radicado=" + IdTemp + "&NombrePlantilla=" + NombrePlantilla + "&id_ruta=" + IdRuta,
                        beforeSend: function () {
                            $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando información, por favor espere. </div>');
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
                    sweetAlert("Oops...", msj, "error");
                }
            },
            error: function (msj) {
                $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });
    }

    $(document).on("click", "#TipoVer", function (event) {
        $("#tipo_ver").val($(this).data("tipo_ver"));
        load(1);
    });

    $(document).on("click", "#BtnCargarPlantillaQuienFirma", function (e) {
        $("#id_temp").val($(this).data("id_temp"));
        $("#id_funcio_deta").val($(this).data("id_funcio_deta"));
        $("#tipo_funcionario").val("QUIEN_FIRMA");
        $("#estado_gestion").val($(this).data("estado_gestion"));

        $("#funcio_quien_firma").val($(this).data("funcio_quien_firma"));
        $("#funcio_responsable").val($(this).data("funcio_responsable"));
        $("#funcio_proyector").val($(this).data("funcio_proyector"));
    });

    $(document).on("click", "#BtnCargarPlantillaResponsable", function (e) {
        $("#id_temp").val($(this).data("id_temp"));
        $("#id_funcio_deta").val($(this).data("id_funcio_deta"));
        $("#tipo_funcionario").val("RESPONSABLE");
        $("#estado_gestion").val($(this).data("estado_gestion"));

        $("#funcio_quien_firma").val($(this).data("funcio_quien_firma"));
        $("#funcio_responsable").val($(this).data("funcio_responsable"));
        $("#funcio_proyector").val($(this).data("funcio_proyector"));
    });

    $(document).on("click", "#BtnCargarPlantillaProyector", function (e) {
        $("#id_temp").val($(this).data("id_temp"));
        $("#id_funcio_deta").val($(this).data("id_funcio_deta"));
        $("#tipo_funcionario").val("PROYECTOR");
        $("#estado_gestion").val($(this).data("estado_gestion"));

        $("#funcio_quien_firma").val($(this).data("funcio_quien_firma"));
        $("#funcio_responsable").val($(this).data("funcio_responsable"));
        $("#funcio_proyector").val($(this).data("funcio_proyector"));
    });

    $(document).on("click", "#BtnSubirPlantilla", function (e) {
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
                        $("#id_ruta").val(Elementos[1]);
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se subio correctamente.</div>');
                        $("#myModalAdjuntarDocumento").modal("hide");

                        var formDataPlantilla = new FormData($(".formulario")[0]);
                        var IdTemp = $("#id_temp").val();
                        var IdFuncioDeta = $("#id_funcio_deta").val();
                        var TipoFuncionario = $("#tipo_funcionario").val();
                        var EstadoGestion = $("#estado_gestion").val();

                        $.ajax({
                            url: "acciones.ajax.php",
                            type: "POST",
                            data: formDataPlantilla,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="20" height="20" /> Estableciendo criterios, por favor espere...</div>');
                            },
                            success: function (msj) {
                                if (msj == 1) {
                                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se subio correctamente. </div>');

                                    $("#BtnCancelarCargarPlantilla").click();

                                    if (TipoFuncionario === "QUIEN_FIRMA" && EstadoGestion == 0) {
                                        swal(
                                            {
                                                title: "Subiste la plantilla pero aun no las has firmado ¿Desea firmar el documento?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#f0ad4e",
                                                confirmButtonText: "Si, Firmar el documento!",
                                                closeOnConfirm: false,
                                            },
                                            function () {
                                                $.ajax({
                                                    url: "acciones.ajax.php",
                                                    type: "POST",
                                                    data: "accion=FIRMAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                                                    beforeSend: function () {
                                                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                                                    },
                                                    success: function (msj) {
                                                        if (msj == 1) {
                                                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue firmado correctamente. </div>');
                                                            swal("Ok!", "El documento fue firmado correctamente.", "success");
                                                        } else {
                                                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                                                        }
                                                    },
                                                    error: function (msj) {
                                                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                                                    },
                                                });
                                            }
                                        );
                                    } else if (TipoFuncionario === "RESPONSABLE" && EstadoGestion == 0) {
                                        swal(
                                            {
                                                title: "Subiste la plantilla pero aun no las has aprobado ¿Desea aprobar el documento?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#f0ad4e",
                                                confirmButtonText: "Si, Aprobar el documento!",
                                                closeOnConfirm: false,
                                            },
                                            function () {
                                                $.ajax({
                                                    url: "acciones.ajax.php",
                                                    type: "POST",
                                                    data: "accion=APROBAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                                                    beforeSend: function () {
                                                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                                                    },
                                                    success: function (msj) {
                                                        if (msj == 1) {
                                                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                                                            swal("Ok!", "El documento fue aprobado correctamente.", "success");
                                                        } else {
                                                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                                                        }
                                                    },
                                                    error: function (msj) {
                                                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                                                    },
                                                });
                                            }
                                        );
                                    } else if (TipoFuncionario === "PROYECTOR" && EstadoGestion == 0) {
                                        swal(
                                            {
                                                title: "Subiste la plantilla pero aun no has terminado de proyectarla ¿Desea terminar la proyección del documento?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#f0ad4e",
                                                confirmButtonText: "Si, Terminar proyección!",
                                                closeOnConfirm: false,
                                            },
                                            function () {
                                                $.ajax({
                                                    url: "acciones.ajax.php",
                                                    type: "POST",
                                                    data: "accion=PROYECTAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                                                    beforeSend: function () {
                                                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                                                    },
                                                    success: function (msj) {
                                                        if (msj == 1) {
                                                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento se proyecto correctamente. </div>');
                                                            swal("Ok!", "El documento se proyecto correctamente.", "success");
                                                        } else {
                                                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                                                        }
                                                    },
                                                    error: function (msj) {
                                                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                                                    },
                                                });
                                            }
                                        );
                                    }
                                }

                                load(1);
                            },
                            error: function (msj) {
                                $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                            },
                        });
                    } else {
                        sweetAlert("Oops...", msj, "error");
                    }
                },
            });
        }
    });

    $(document).on("click", "#BtnListarNotas", function (e) {
        e.preventDefault;

        $("#id_temp").val($(this).data("id_temp"));

        $.ajax({
            url: "listar_notas.php",
            type: "POST",
            data: "IdTemp=" + $("#id_temp").val(),
            beforeSend: function () {
                $("#DivListarNotas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
            },
            success: function (msj) {
                $("#DivListarNotas").html(msj);
            },
            error: function (msj) {
                $("#DivListarNotas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });

        return false;
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
                if ((msj = 1)) {
                    $("#DivAlertasNotas").empty();
                    $("#nota").val("");

                    $.ajax({
                        url: "listar_notas.php",
                        type: "POST",
                        data: "IdTemp=" + $("#id_temp").val(),
                        beforeSend: function () {
                            $("#DivListarNotas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                        },
                        success: function (msj) {
                            $("#DivListarNotas").html(msj);
                        },
                        error: function (msj) {
                            $("#DivListarNotas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                        },
                    });
                } else {
                    $("#DivAlertasNotas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertasNotas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
            },
        });
    });

    $(document).on("click", "#BtnFirmar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");
        var SubioPlantilla = $(this).data("subio_plantilla");

        var IdDepen = $(this).data("id_depen");
        var Responsable = $(this).data("responsable");
        var TipoFuncionario = $(this).data("tipo_funcionario");
        var PlantillaGenerada = $(this).data("plantillta_generada");
        var PlantillaCargada = $(this).data("plantillta_cargada");
        var NombrePlantilla = $(this).data("plantillta_nombre");
        var IdRuta = $(this).data("id_ruta");

        if (DescargoPlantilla == 0) {
            swal(
                {
                    title: "No puedes firmar el documento sin haber descargado la plantilla, ¿Deseas descargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Descargar plantilla!",
                    closeOnConfirm: false,
                },

                function () {
                    Descargar_Plantilla(IdTemp, IdFuncioDeta, IdDepen, Responsable, TipoFuncionario, PlantillaGenerada, PlantillaCargada, NombrePlantilla, IdRuta);
                }
            );
        } else if (SubioPlantilla == 0) {
            swal(
                {
                    title: "No puedes firmar el documento sin haber cargado la plantilla, ¿Deseas cargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Cargar plantilla!",
                    closeOnConfirm: false,
                },

                function () {
                    $("#BtnSubirPlantilla").click();
                }
            );
        } else {
            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data: "accion=FIRMAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue firmado correctamente. </div>');
                        swal("Ok!", "El documento fue firmado correctamente.", "success");
                    } else {
                        $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                },
            });
        }

        load(1);
    });

    $(document).on("click", "#BtnQuitarFirmar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");
        var SubioPlantilla = $(this).data("subio_plantilla");

        swal(
            {
                title: "Retirar firma?.",
                text: "Desea retirar la firma del documento!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Retirar firma!",
                closeOnConfirm: false,
            },
            function () {
                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=QUITAR_FIRMA&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La firma se retiro correctamente.</div>');
                            swal("Ok!", "La firma se retiro correctamente.", "success");
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                    },
                });
            }
        );

        load(1);
    });

    $(document).on("click", "#BtnAprobar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");
        var SubioPlantilla = $(this).data("subio_plantilla");

        if (DescargoPlantilla == 0) {
            swal(
                {
                    title: "No puedes aprobar el documento sin haber descargado la plantilla, ¿Deseas descargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Descargar plantilla!",
                    closeOnConfirm: false,
                },
                function () {
                    $("#BtnDescargaPlantilla").click();
                }
            );
        } else if (SubioPlantilla == 0) {
            swal(
                {
                    title: "No puedes aprobar el documento sin haber cargado la plantilla, ¿Deseas cargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Cargar plantilla!",
                    closeOnConfirm: false,
                },
                function () {
                    $("#BtnCargarPlantillaResponsable").click();
                }
            );
        } else {
            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data: "accion=APROBAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                        swal("Ok!", "El documento fue aprobado correctamente.", "success");
                    } else {
                        $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                },
            });
        }

        load(1);
    });

    $(document).on("click", "#BtnQuitarAprobar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");
        var SubioPlantilla = $(this).data("subio_plantilla");

        swal(
            {
                title: "Retirar aprobación?",
                text: "Desea quietar la aprobación el documento!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Quietar la aprobación!",
                closeOnConfirm: false,
            },
            function () {
                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=QUITAR_APROBACION&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento 	ya no esta aprobado.</div>');
                            swal("Ok!", "El documento 	ya no esta aprobado.", "success");
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                    },
                });
            }
        );

        load(1);
    });

    $(document).on("click", "#BtnProyectar", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");
        var SubioPlantilla = $(this).data("subio_plantilla");

        if (DescargoPlantilla == 0) {
            swal(
                {
                    title: "No puedes terminar la proyección el documento sin haber descargado la plantilla, ¿Deseas descargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Descargar plantilla!",
                    closeOnConfirm: false,
                },
                function () {
                    $("#BtnDescargaPlantilla").click();
                }
            );
        } else if (SubioPlantilla == 0) {
            swal(
                {
                    title: "No puedes proyectar el documento sin haber cargado la plantilla, ¿Deseas cargar la plantillla?.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Si, Cargar plantilla!",
                    closeOnConfirm: false,
                },
                function () {
                    $("#id_temp").val($(this).data("id_temp"));
                    $("#id_funcio_deta").val($(this).data("id_funcio_deta"));
                    $("#tipo_funcionario").val("PROYECTOR");
                    $("#estado_gestion").val($(this).data("estado_gestion"));
                    $("#myModalSubirPlantilla").modal("show");
                }
            );
        } else {
            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data: "accion=PROYECTAR_DOCUMENTO&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                        swal("Ok!", "El documento fue aprobado correctamente.", "success");
                    } else {
                        $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                },
            });
        }

        load(1);
    });

    $(document).on("click", "#BtnAnularTemp", function (e) {
        e.preventDefault;

        var IdTemp = $(this).data("id_temp");
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var DescargoPlantilla = $(this).data("descargo_plantilla");

        swal(
            {
                title: "¿Deseas anular la plantillla?.",
                text: "La plantilla sera anulada y no se mostrara mas, ¿Deseas anular la plantilla?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Anular plantilla!",
                closeOnConfirm: false,
            },
            function () {
                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=ANULAR_TEMP&IdTemp=" + IdTemp + "&IdFuncioDeta=" + IdFuncioDeta,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El documento fue aprobado correctamente. </div>');
                            swal("Ok!", "El documento fue aprobado correctamente.", "success");
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                    },
                });
            }
        );

        load(1);
    });

    $(document).on("click", "#BtnListarRadicadosAsociados", function (e) {
        swal("Ok!", "El documento fue aprobado correctamente.", "success");
    });

    $(document).on("click", "#BtnListarRadicadosAsociados", function (e) {
        var IdTemp = $(this).data("id_temp");

        $.ajax({
            url: "listar_radicados_asociados.php",
            type: "POST",
            data: "IdTemp=" + IdTemp,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#DivListarRadicadosAsociados").empty();
                $("#DivListarRadicadosAsociados").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    //FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on("click", "#BtnMostarInfoRadicadoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        alert(IdRadicado);

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
});
