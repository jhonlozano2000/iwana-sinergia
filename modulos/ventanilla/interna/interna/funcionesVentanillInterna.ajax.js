$(document).ready(function () {
    $("#BtnRadicar").click(function () {
        if ($("#fec_docu").val() == "") {
            sweetAlert("Oops...", "Te hizo falta la fecha del documento!", "warning");
            $("#fec_docu").focus();
        } else if ($("#num_folio").val() == "") {
            sweetAlert("Oops...", "Te hizo falta el numéro de folios del documento!", "warning");
            $("#num_folio").focus();
        } else if ($("#chkTerms").prop("checked") === true && $("#fec_venci").val() === "") {
            sweetAlert("Oops...", "Te hizo falta la fecha de vencimiento del documento!", "warning");
            $("#fec_venci").focus();
        } else if ($("#num_anexos").val() === "") {
            sweetAlert("Oops...", "Te hizo falta el número de los anexos!", "warning");
            $("#num_anexos").focus();
        } else if ($("#observa_anexos").val() === "") {
            sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
            $("#observa_anexos").focus();
        } else if ($("#asunto").val() == "") {
            sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
            $("#asunto").focus();
        } else if (!$('input[name="ChkResponsables[]"]').is(":checked")) {
            sweetAlert("Oops...", "Te hizo falta el o los responsables de la correspondencia!", "warning");
        } else if (!$('input[name="ChkFuncioRespon"]').is(":checked")) {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else if (!$('input[name="ChkDestinatarios[]"]').is(":checked")) {
            sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
            $("#BtnBuscarDestinatario").click();
        } else if ($("#incluir_trd").val() == 1 && $("#id_serie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta la Serie de la clasificación documental de la correspondencia!", "warning");
            $("#id_serie").focus();
        } else if ($("#incluir_trd").val() == 1 && $("#id_subserie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta la Subserie de la clasificación documental de la correspondencia!", "warning");
            $("#id_subserie").focus();
        } else if ($("#id_tipodoc").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta el tipo documental de la clasificación documental de la correspondencia!", "warning");
            $("#id_tipodoc").focus();
        } else {
            var formData = new FormData($("#Frm-Data")[0]);

            $.ajax({
                url: "accionesVentanillaInterna.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');

                        setTimeout(function () {
                            window.location.href = "index.php";
                        }, 200);
                    } else {
                        sweetAlert("Oops...", msj + "!", "warning");
                    }
                },
                error: function () {
                    sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
                },
            });
        }
        return false;
    });

    $("#BtnSubirDigital").click(function () {
        let tipoCargueArchivo = $("#tipo_cargue_archivos").val();
        var formData = new FormData($(".formularioCargueDigital")[0]);
        formData.append("tipo_cargue_archivos", tipoCargueArchivo);

        if (tipoCargueArchivo == 0) {
            var urlParaCargarArchivo = "../../../varios/ftp.acciones.php";
        } else if (tipoCargueArchivo == 1) {
            var urlParaCargarArchivo = "../../../varios/admin_getion_files.php";
        }

        $.ajax({
            url: urlParaCargarArchivo,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#BtnCancelarSubirDigital").click();
                    $("#DivAlertarAdjuntoDigital").empty();
                } else {
                    sweetAlert("Oops...", msj, "error");
                }
            },
            warning: function () {
                sweetAlert("Oops...", msj, "error");
            },
        });
    });

    $(document).on("click", "#BtnSubirDocumentosAdicionales", function (event) {
        $("#id_radicado").val($(this).data("id_radicado"));
        $("#id_depen").val($(this).data("id_depen"));
    });

    $(document).on("click", "#BtnSubirArchivosAdicionales", function (event) {
        let tipoCargueArchivo = $("#tipo_cargue_archivos").val();

        if (tipoCargueArchivo == 0) {
            var urlParaCargarArchivo = "../../../varios/ftp.acciones.php";
        } else if (tipoCargueArchivo == 1) {
            var urlParaCargarArchivo = "../../../varios/admin_getion_files.php";
        }

        $.ajax({
            url: urlParaCargarArchivo,
            type: "POST",
            data: "accion=INTERNO_UPLOAD_ADJUNTOS&id_radicado=" + $("#id_radicado").val(),
            beforeSend: function () {
                $("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#BtnCancelarSubirArchivosAdicionales").click();
                } else {
                    sweetAlert("Oops...", msj, "error");
                }
            },
            warning: function (msj) {
                sweetAlert("Oops...", msj, "error");
            },
        });
    });

    //FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on("click", "#BtnMostarInfoRadicadoInterno", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        var NombreArchivo = $(this).data("nombre_archivo");

        $("#DivRadicadoInterno").html(IdRadicado);

        $.ajax({
            url: "../../varios/tab_radicado_interno_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoInterno").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_interno_clasificacion.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoInternoClasificacionDocumental").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_interno_documentos.php",
            type: "POST",
            data: "id_radica=" + IdRadicado + "&nombre_archivo=" + NombreArchivo,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarDocumentosInterno").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_interno_otra_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivOtraInfoRadicadoInterno").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnDescargarArchivoInterno", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        window.location.href = "../../../varios/admin_file.php?accion=INTERNO_DOWNLOAD&id_radicado=" + IdRadicado;
    });

    $(document).on("click", "#BtnDescargarArchivoInternoAdjuntos", function (event) {
        var IdArchivo = $(this).data("id_archivo");

        let tipoCargueArchivo = $("#tipo_cargue_archivos").val();
        var IdRadicado = $(this).data("id_radicado");
        var IdRuta = $(this).data("id_ruta");
        var Archivo = $(this).data("archivo");

        if (tipoCargueArchivo == 0) {
            if ($("#id_ruta").val() == 0) {
                sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
            } else {
                $.ajax({
                    url: "../../../varios/ftp.acciones.php",
                    type: "POST",
                    data: "accion=INTERNO_DOWNLOAD&id_radicado=" + IdRadicado + "&id_ruta=" + IdRuta + "&tipo_cargue_archivos=" + tipoCargueArchivo,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        $("#DivAlertas").empty();
                        if (msj == 1) {
                            url = "../../../../archivos/temp/enviados/" + Archivo;
                            window.open(url, "Download");
                        } else {
                            sweetAlert("Oops...", msj, "error");
                        }
                    },
                    error: function (error) {
                        sweetAlert("Oops...", error, "error");
                    },
                });
            }
        } else {
            window.location.href = "../../../varios/admin_file.php?accion=INTERNO_DOWNLOAD_ADJUNTO&archivo_id=" + IdArchivo;
        }
    });

    $("#BtnBuscarRadicadosInternos").click(function (e) {
        $("#TxtBusRadicadosInternosParaRespuesta").focus();
    });

    //FUNCION PARA BUSCAR EL TERCERO NATURAL
    $("#TxtBusRadicadosInternosParaRespuesta").keyup(function (e) {
        if (e.which == 13) {
            if ($("#TxtBusRadicadosInternosParaRespuesta").val() === "") {
                $("#DivAlertasRadicadosInternosParaRespuesta").load(
                    "../../../config/funciones.php",
                    {
                        alerta: 3,
                        mensaje: "Te hizo falta ingresar el criterio de busqueda",
                    },
                    function () {}
                );
                $("#TxtBusRadicadosInternosParaRespuesta").focus();
            } else {
                $.ajax({
                    url: "../../varios/listar_radicados_internos_para_respuesta.php",
                    type: "POST",
                    data: "criterio=" + $("#TxtBusRadicadosInternosParaRespuesta").val(),
                    beforeSend: function () {
                        $("#DivAlertasRadicadosInternosParaRespuesta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        $("#DivAlertasRadicadosInternosParaRespuesta").empty();
                        if (msj != 1) {
                            $("#DivRadicadosInternosParaRespuesta").html(msj);
                        } else {
                            $("#DivRadicadosInternosParaRespuesta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasRadicadosInternosParaRespuesta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        }
    });
    //FUNCION PARA BORRAR UN RESPONSABLES
    $(document).on("click", ".borrar_responsables", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkResponsables" + $(this).data("id")).attr("checked", false);
    });

    //FUNCION PARA LLEVAR LOS RESPONSABLES
    $("#BtnLlevarResponsables").click(function (e) {
        $("input[name='ChkResponsables[]']:checked").each(function () {
            if (!$("#TblResponsales" + $(this).val()).length) {
                $("#TblResponsales tr:last").after('<tr id="TblResponsales' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon' + $(this).val() + '" value="' + $(this).val() + '" data-id_responsable_dependencia="' + $(this).data("id_dependencia_responsables") + '" data-id_responsable_oficina="' + $(this).data("id_oficina_responsables") + '"><label for="ChkFuncioRespon' + $(this).val() + '">' + $(this).data("nombre_responsables") + "</label></div></td><td>" + $(this).data("oficina_responsables") + '</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA BORRAR UN DESTINATARIOS
    $(document).on("click", "#BtnBorraDestinatarios", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkDestinatarios" + $(this).data("id")).prop("checked", false);
    });

    //FUNCION PARA LLEVAR LOS DESTINATARIOS
    $("#BtnLlevarDestinatarios").click(function () {
        $("input[name='ChkDestinatarios[]']:checked").each(function () {
            if (!$("#TrDestinatarios" + $(this).val()).length) {
                $("#TblDestinatarios tr:last").after('<tr id="TrDestinatarios' + $(this).val() + '"><td>' + $(this).data("nombre_destinatario") + "</td><td>" + $(this).data("oficina_destinatario") + '</td><td><button class="btn btn-danger btn-sm btn-small" id="BtnBorraDestinatarios" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA BORRAR UN PROYECTORES
    $(document).on("click", "#BtnBorraProyectores", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkProyectores" + $(this).data("id")).prop("checked", false);
    });

    //FUNCION PARA LLEVAR LOS PROYECTORES
    $("#BtnLlevarProyectores").click(function () {
        $("input[name='ChkProyectores[]']:checked").each(function () {
            if (!$("#TrProyectores" + $(this).val()).length) {
                $("#TblProyectores tr:last").after('<tr id="TrProyectores' + $(this).val() + '"><td>' + $(this).data("nombre_proyector") + "</td><td>" + $(this).data("oficina_proyector") + '</td><td><button class="btn btn-danger btn-sm btn-small" id="BtnBorraProyectores" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA BORRAR CON COPIA
    $(document).on("click", "#BtnBorraDestinatarios", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkDestinatarios" + $(this).data("id")).prop("checked", false);
    });

    //FUNCION PARA LLEVAR CON COPIA
    $("#BtnLlevarConCopia").click(function () {
        $("input[name='ChkConCopia[]']:checked").each(function () {
            if (!$("#TrConCopia" + $(this).val()).length) {
                $("#TblConCopia tr:last").after('<tr id="TrConCopia' + $(this).val() + '"><td>' + $(this).data("nombre_destinatario") + "</td><td>" + $(this).data("oficina_destinatario") + '</td><td><button class="btn btn-danger btn-sm btn-small" id="BtnBorraDestinatarios" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO
    $("body").on("change", ".dependencia_del_responsable", function (event) {
        event.preventDefault();

        var IdDepen = $(this).data("id_responsable_dependencia");
        var IdOficina = $(this).data("id_responsable_oficina");
        var IncluirOficinaTRD = $("#incluir_oficina_trd").val();

        $("#id_depen").val(IdDepen);
        $("#id_oficina").val(IdOficina);
        $("#id_responsable").val($(this).val());

        $.post(
            "../../../varios/combo_series.php",
            {
                id_depen: IdDepen,
                id_oficina: IdOficina,
                IncluirOficinaTRD: IncluirOficinaTRD,
            },
            function (data) {
                $("#id_serie").html(data);
            }
        );
    });

    //FUNCION PARA IMPRIMIR ROTULO
    $(document).on("click", ".ImprimirRotulo", function (event) {
        if ($("#tipo_impre_torulo").val() == 1) {
            $("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_interno_tickect.php?id_radica=" + $(this).data("id_radicado"));
        } else if ($("#tipo_impre_torulo").val() == 2) {
            $("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_interno_documento.php?id_radica=" + $(this).data("id_radicado"));
        }

        $.ajax({
            url: "accionesVentanillaInterna.ajax.php",
            type: "POST",
            data: "accion=IMPRIMIR_ROTULO&id_radica=" + $(this).data("id_radicado"),
            success: function (data) {
                if (data == 1) {
                    $("i[id=BtnImprimirRotulo" + $("#id_radicado").val() + "]").removeClass("text-warning");
                    $("i[id=BtnImprimirRotulo" + $("#id_radicado").val() + "]").addClass("text-success");
                } else {
                    $("i[id=BtnImprimirRotulo" + $("#id_radicado").val() + "]").removeClass("text-warning");
                    $("i[id=BtnImprimirRotulo" + $("#id_radicado").val() + "]").addClass("text-danger");
                }
            },
            error: function (data) {
                sweetAlert("Oops...", data, "warning");
            },
        });
    });

    //LIMPIAR LA FECHA DE VENCIEMIENTO CUANDO NO REQUIERE RESPUESTA
    $("#chkTerms").change(function () {
        var Respues = $("#chkTerms").prop("checked") ? true : false;
        if (Respues == false) {
            $("#fec_venci").val("");
        }
    });

    $("#id_serie").change(function () {
        var Responsables = new Array();

        $("input[name='ChkResponsables[]']:checked").each(function () {
            Responsables.push($(this).val());
        });

        if (Responsables == "") {
            sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
            $("#BtnBuscarDestinatario").click();
        } else if (!$('input[name="ChkResponsables[]"]').is(":checked")) {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else {
            $("#id_serie option:selected").each(function () {
                $.post(
                    "../../../varios/combo_sub_series.php",
                    {
                        id_serie: $(this).val(),
                        id_depen: $("#id_depen").val(),
                        id_oficina: $("#id_oficina").val(),
                        IncluirOficinaTRD: $("#incluir_oficina_trd").val(),
                    },
                    function (data) {
                        $("#id_subserie").html(data);
                    }
                );
            });
        }
    });

    $("#id_subserie").change(function () {
        $("#id_subserie option:selected").each(function () {
            var id_serie = $("#id_serie").val();
            var id_sub_serie = $(this).val();

            $.post(
                "../../../varios/combo_tipos_documentos.php",
                {
                    accion: $("#accion").val(),
                    id_depen: $("#id_depen").val(),
                    id_serie: id_serie,
                    id_sub_serie: id_sub_serie,
                },
                function (data) {
                    $("#id_tipodoc").html(data);
                }
            );
        });
    });

    //FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
    //EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
    $(document).on("click", ".idradicado", function (event) {
        $("#IdRadicado").val($(this).data("id_radicado"));
        $("#id_radicado").val($(this).data("id_radicado"));
        $("#id_depen").val($(this).data("id_depen"));
    });

    $(document).on("click", ".ImprimirRotulo", function (event) {
        $("#IdRadicado").val($(this).data("id_radicado"));
        $("#id_radicado").val($(this).data("id_radicado"));
    });

    $(document).on("change", ".ojo", function (event) {
        $("#id_responsable").val($(this).val());
    });
});
