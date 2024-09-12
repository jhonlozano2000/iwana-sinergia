$(document).ready(function () {
    $("#BtnRadicarRecibidas").click(function () {
        let RequiRespues = $("#chkTerms").prop("checked") ? 1 : 0;
        let NumAnexos = $("#num_anexos").val();
        let Destinatarios = new Array();
        let idResponsable = $("#id_responsable").val();

        $("input[name='ChkFuncionariosResponsables[]']").each(function () {
            Destinatarios.push($(this).val());
        });

        if ($("#fec_docu").val() == "") {
            sweetAlert("Oops...", "Te hizo falta la fecha del documento!", "warning");
            $("#fec_docu").focus();
        } else if (RequiRespues === true && $("#fec_venci").val() === "") {
            sweetAlert("Oops...", "Te hizo falta la fecha de vencimiento del documento!", "warning");
            $("#fec_venci").focus();
        } else if ($("#id_tipo_correspon").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta el tipo de correspondencia de la correspondencia!", "warning");
            $("#id_tipo_correspon").focus();
        } else if ($("#num_folio").val() === "") {
            sweetAlert("Oops...", "Te hizo falta el numéro de folios del documento!", "warning");
            $("#num_folio").focus();
        } else if ($("#num_anexos").val() === "") {
            sweetAlert("Oops...", "Te hizo falta el total de los anexos!", "warning");
            $("#num_anexos").focus();
        } else if ($("#observa_anexo").val() === "") {
            sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
            $("#observa_anexo").focus();
        } else if ($("#asunto").val() === "") {
            sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
            $("#asunto").focus();
        } else if (Destinatarios.length == 0) {
            sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
            $("#BtnBuscarDestinatario").click();
        } else if (idResponsable === "") {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else if ($("#id_tercero").val() == "") {
            sweetAlert("Oops...", "Te hizo falta el tercero de la correspondencia!", "warning");
        } else if ($("#id_forma_llegada").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta la forma de llegada de la correspondencia!", "warning");
            $("#id_forma_llegada").focus();
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
            $.ajax({
                url: "accionesVentanillaRecibidas.php",
                type: "POST",
                data:
                    "accion=GUARDAR_RADICADO&id_serie=" +
                    $("#id_serie").val() +
                    "&id_subserie=" +
                    $("#id_subserie").val() +
                    "&id_tipodoc=" +
                    $("#id_tipodoc").val() +
                    "&id_tipo_correspon=" +
                    $("#id_tipo_correspon").val() +
                    "&id_forma_llegada=" +
                    $("#id_forma_llegada").val() +
                    "&id_tercero=" +
                    $("#id_tercero").val() +
                    "&fechor_radica=" +
                    $("#fechor_radica").val() +
                    "&fec_docu=" +
                    $("#fec_docu").val() +
                    "&requie_respues=" +
                    RequiRespues +
                    "&fec_venci=" +
                    $("#fec_venci").val() +
                    "&asunto=" +
                    $("#asunto").val() +
                    "&num_folio=" +
                    $("#num_folio").val() +
                    "&num_anexos=" +
                    NumAnexos +
                    "&observa_anexo=" +
                    $("#observa_anexo").val() +
                    "&responsable=" +
                    idResponsable +
                    "&Destinatarios=" +
                    Destinatarios +
                    "&incluir_trd=" +
                    $("#incluir_trd").val() +
                    "&opcion_relacion=" +
                    $("#opcion_relacion").val() +
                    "&opcion_titulo=" +
                    $("#opcion_titulo").val() +
                    "&opcion_sub_titulo=" +
                    $("#opcion_sub_titulo").val() +
                    "&opcion_detalle1=" +
                    $("#opcion_detalle1").val() +
                    "&opcion_detalle2=" +
                    $("#opcion_detalle2").val() +
                    "&opcion_detalle3=" +
                    $("#opcion_detalle3").val(),
                beforeSend: function () {
                    $("#DivAlertas").load(
                        "../../../../config/mensajes.php",
                        {
                            alerta: 5,
                            mensaje: "Enviando información, por favor espere...",
                        },
                        function () {}
                    );
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
    });

    $("#BtnSubirDigitalRecibido").click(function () {
        var formData = new FormData($(".formulario")[0]);

        var urlParaCargarArchivo = "../../../varios/upload_file.php";

        $.ajax({
            url: urlParaCargarArchivo,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#DivAlertarAdjuntoDigital").load(
                    "../../../../config/mensajes.php",
                    {
                        alerta: 5,
                        mensaje: "Enviando información, por favor espere...",
                    },
                    function () {}
                );
            },
            success: function (msj) {
                console.log(msj);
                if (msj == 1) {
                    $("#BtnCancelarSubirDigitalRecibido").click();
                    $("#DivAlertarAdjuntoDigital").empty();
                    $("#ifrVisualizaArchivo").attr("src", "");
                } else {
                    sweetAlert("Oops...", msj, "error");
                }
            },
            warning: function () {
                sweetAlert("Oops...", msj, "error");
                console.log(msj);
            },
        });
    });

    $("#BtnGuardarTerceroNatural").click(function () {
        if ($("#nom_contac").val() == "") {
            $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del contacto." }, function () {});
            $("#nom_contac").focus();
        } else if ($("#id_depar_natural").val() == 0) {
            $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el departamento de recidencia del contacto." }, function () {});
            $("#id_depar_natural").focus();
        } else if ($("#id_muni_natural").val() == 0) {
            $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el municipio de recidencia del contacto." }, function () {});
            $("#id_muni_natural").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroNatural")[0]);

            $.ajax({
                url: "../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                },
                success: function (msj) {
                    var Elementos = msj.split("####");

                    if (Elementos[0] == 1) {
                        $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#id_tercero").val(Elementos[1]);
                        $("#cc_nit").val($("#num_docu_contac").val());
                        $("#remite_contacto").val($("#nom_contac").val());
                        $("#DivReriteRazoSoci").hide();
                        $("#remite_dir").val($("#dir_contac").val());
                        $("#remite_tel").val($("#tel_contac").val());
                        $("#remite_cel").val($("#cel_contac").val());
                        $("#remite_email").val($("#email_contac").val());

                        $("#FrmDatosTerceroNatural")[0].reset();
                        $("#DivOcultarRemiteRazoSoci").hide();
                        $("#BtnCancelarTerceroNatural").click();
                        $("#DivAlertaTerceroNatural").empty();
                    } else {
                        $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    $("#BtnGuardarTerceroJutidico").click(function () {
        if ($("#nom_contac_juridico").val() == "") {
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del contacto." }, function () {});
            $("#nom_contac_juridico").focus();
        } else if ($("#multi").val() == 0) {
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_empre_juridico").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroJuridico")[0]);

            $.ajax({
                url: "../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroJutidico").load(
                        "../../../../config/mensajes.php",
                        {
                            alerta: 5,
                            mensaje: "Enviando información, por favor espere...",
                        },
                        function () {}
                    );
                },
                success: function (msj) {
                    var Elementos = msj.split("####");
                    if (Elementos[0] == 1) {
                        $("#id_tercero").val(Elementos[1]);
                        $("#cc_nit").val(Elementos[2]);
                        $("#remite_contacto").val($("#nom_contac_juridico").val());
                        $("#remite_razo_soci").val($('select[name="multi"] option:selected').text());
                        $("#remite_dir").val($("#dir_contac_juridico").val());
                        $("#remite_tel").val($("#tel_contac_juridico").val());
                        $("#remite_cel").val($("#cel_contac_juridico").val());
                        $("#remite_email").val($("#email_contac_juridico").val());

                        $("#FrmDatosTerceroJuridico")[0].reset();
                        $("#BtnCancelarTerceroJutidico").click();
                        $("#DivOcultarRemiteRazoSoci").show();
                        $("#DivAlertaTerceroJutidico").empty();
                    } else {
                        $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    //FUNCION PARA GUARDAR TERCERO JURIDICO CON NUEVA EMPRESA
    $("#BtnGuardarTerceroJutidicoConEmpresa").click(function () {
        if ($("#nit").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Nit. de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#nit").focus();
        } else if ($("#razo_soci").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la Razon Social de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#razo_soci").focus();
        } else if ($("#id_depar_juridico_empresa").val() == 0) {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_depar_juridico_empresa").focus();
        } else if ($("#id_muni_juridico_empresa").val() == 0) {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_muni_juridico_empresa").focus();
        } else if ($("#nom_contac_juridico_empresa").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#nom_contac_juridico_empresa").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroJuridicoConEmpresa")[0]);

            $.ajax({
                url: "../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroJutidico").load(
                        "../../../../config/mensajes.php",
                        {
                            alerta: 5,
                            mensaje: "Enviando información, por favor espere...",
                        },
                        function () {}
                    );
                },
                success: function (msj) {
                    var Elementos = msj.split("####");
                    if (Elementos[0] == 1) {
                        $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
                        $("#id_tercero").val(Elementos[1]);
                        $("#cc_nit").val($("#nit").val());
                        $("#remite_contacto").val($("#nom_contac_juridico_empresa").val());
                        $("#DivReriteRazoSoci").show();
                        $("#remite_razo_soci").val($("#razo_soci").val());
                        $("#remite_dir").val($("#dir_juridico_empresa").val());
                        $("#remite_tel").val($("#tel_juridico_empresa").val());
                        $("#remite_cel").val($("#cel_juridico_empresa").val());

                        $("#FrmDatosTerceroJuridicoConEmpresa")[0].reset();
                        $("#BtnCancelarTerceroJutidicoConEmpresa").click();
                        $("#DivAlertaTerceroJutidicoConEmpresa").empty();
                    } else {
                        $("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    //LIMPIAR FORMULARIO DE TERCEROS NATURALES
    $("#BtnCancelarTerceroNatural").click(function () {
        $("#FrmDatosTerceroNatural")[0].reset();
    });

    $(document).on("click", "#BtnDescargarArchivoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        // Redirige al archivo PHP que maneja la descarga
        window.location.href = "../../../varios/upload_file.php?accion=RECIBIDOS_DESCARGAR&id_radicado=" + IdRadicado;
    });

    $(document).on("click", "#BtnLlevarEditarAsunto", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        var Asunto = $(this).data("asunto");

        $("#id_radica_editar_asunto").val(IdRadicado);
        $("#asunto_editar_asunto").val(Asunto);
    });

    $(document).on("click", "#BtnEditarAsunto", function (event) {
        $.ajax({
            url: "accionesVentanillaRecibidas.php",
            type: "POST",
            data: "accion=EDITAR_ASUNTO&id_radica=" + $("#id_radica_editar_asunto").val() + "&asunto=" + $("#asunto_editar_asunto").val(),
            beforeSend: function () {
                $("#DivAlertasEditarAsunto").load(
                    "../../../../config/mensajes.php",
                    {
                        alerta: 5,
                        mensaje: "Enviando información, por favor espere...",
                    },
                    function () {}
                );
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertasEditarAsunto").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
                } else {
                    $("#DivAlertasEditarAsunto").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnEliminarRadicado", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        var IdRuta = $(this).data("id_ruta");
        var Archivo = $(this).data("archivo");

        swal(
            {
                title: "Eliminar radicado?",
                text: "¿Desea eliminar el radicado " + IdRadicado + "?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡Si, Eliminar!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesVentanillaRecibidas.php",
                    type: "POST",
                    data: "accion=ELIMINAR_RADICADO&id_radica=" + IdRadicado,
                    beforeSend: function () {
                        $("#DivAlertas").load(
                            "../../../../config/mensajes.php",
                            {
                                alerta: 5,
                                mensaje: "Enviando información, por favor espere...",
                            },
                            function () {}
                        );
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El radicado se elimino correctamente. </div>');
                            swal("Deleted!", "El radicado se elimino correctamente.", "success");
                            $("#TRRadicado" + IdRadicado).remove();
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        );
    });

    $(document).on("click", "#BtnEliminarDocumentoDigital", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        var IdRuta = $(this).data("id_ruta");
        var Archivo = $(this).data("archivo");

        swal(
            {
                title: "Eliminar digital?",
                text: "¿Desea eliminar el documento digital del radicado " + IdRadicado + "?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡Si, Eliminar!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesVentanillaRecibidas.php",
                    type: "POST",
                    data: "accion=ELIMINAR_DIGITAL&id_radica=" + IdRadicado,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        );
    });

    $(document).on("click", "#BtnEstablecerRequiereRespues", function (event) {
        var IdRadicado = $(this).data("id_radicado");
        $("#id_radica").val(IdRadicado);
    });

    $(document).on("click", "#BtnActualizarSiRequiereRespuesta", function (event) {
        var IdRadicado = $("#id_radica").val();

        swal(
            {
                title: "Establece si el radicado requiere respuesta?",
                text: "¿Desea establecer la fecha de vencimiento para dar respuesta al radicado " + IdRadicado + "?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡Si, Establecer!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesVentanillaRecibidas.php",
                    type: "POST",
                    data: "accion=REQUIERE_RESPUESTA&id_radica=" + IdRadicado + "&fec_venci=" + $("#new_fec_venci").val(),
                    beforeSend: function () {
                        $("#DivAlertasEstablecerRequiereRespues").load(
                            "../../../../config/mensajes.php",
                            {
                                alerta: 5,
                                mensaje: "Enviando información, por favor espere...",
                            },
                            function () {}
                        );
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertasEstablecerRequiereRespues").load(
                                "../../../../config/mensajes.php",
                                {
                                    alerta: 4,
                                    mensaje: "Enviando información, por favor espere...",
                                },
                                function () {}
                            );

                            $("#BtnCerrarActualizarSiRequiereRespuesta").click();
                            $("#DivAlertasEstablecerRequiereRespues").empty();
                            $("#BtnRecargar").click();
                        } else {
                            $("#DivAlertasEstablecerRequiereRespues").load(
                                "../../../../config/mensajes.php",
                                {
                                    alerta: 3,
                                    mensaje: msj,
                                },
                                function () {}
                            );
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasEstablecerRequiereRespues").load(
                            "../../../../config/mensajes.php",
                            {
                                alerta: 1,
                                mensaje: msj,
                            },
                            function () {}
                        );
                    },
                });
            }
        );
    });

    $(document).on("click", "#BtnActualizarNoRequiereRespuesta", function (event) {
        var IdRadicado = $("#id_radica").val();

        swal(
            {
                title: "Elimnar si el radicado requiere respuesta?",
                text: "¿Desea la eliminar la fecha de vencimiento del radicado " + IdRadicado + "?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡Si, Elimnar fecha de vencimiento!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesVentanillaRecibidas.php",
                    type: "POST",
                    data: "accion=QUITAR_REQUIERE_RESPUESTA&id_radica=" + IdRadicado,
                    beforeSend: function () {
                        $("#DivAlertasEstablecerRequiereRespues").load(
                            "../../../../config/mensajes.php",
                            {
                                alerta: 5,
                                mensaje: "Enviando información, por favor espere...",
                            },
                            function () {}
                        );
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertasEstablecerRequiereRespues").load(
                                "../../../../config/mensajes.php",
                                {
                                    alerta: 4,
                                    mensaje: "Enviando información, por favor espere...",
                                },
                                function () {}
                            );

                            $("#BtnCerrarActualizarSiRequiereRespuesta").click();
                            $("#DivAlertasEstablecerRequiereRespues").empty();
                            $("#BtnRecargar").click();
                        } else {
                            $("#DivAlertasEstablecerRequiereRespues").load(
                                "../../../../config/mensajes.php",
                                {
                                    alerta: 3,
                                    mensaje: msj,
                                },
                                function () {}
                            );
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasEstablecerRequiereRespues").load(
                            "../../../../config/mensajes.php",
                            {
                                alerta: 1,
                                mensaje: msj,
                            },
                            function () {}
                        );
                    },
                });
            }
        );
    });

    //FUNCION PARA BORRAR UN RESPONSABLES
    $(document).on("click", ".borrar_destinatario", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkDestinatarios" + $(this).data("id")).prop("checked", false);
    });

    //FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on("click", "#BtnMostarInfoRadicadoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $("#DivRadicadoRecibido").html(IdRadicado);

        $.ajax({
            url: "../../varios/tab_radicado_recibido_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
            url: "../../varios/tab_radicado_recibido_clasificacion.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
            url: "../../varios/tab_radicado_recibido_documentos.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
            url: "../../varios/tab_radicado_recibido_otra_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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

    //FUNCION PARA LLEVAR LOS RESPONSABLES
    $(".BtnLlevarDestinatarios").click(function (event) {
        event.preventDefault();

        let idFuncioDeta = $(this).data("id_funcio_deta");
        let nombreDestinatario = $(this).data("nombre_destinatario");
        let idDependenciaDestinatario = $(this).data("id_dependencia_destinatario");
        let idOficinaDestinatario = $(this).data("id_oficina_destinatario");
        let oficinaDestinatario = $(this).data("oficina_destinatario");

        $("#TblDestinatarios tr:last").after('<tr id="TrDestinatarios' + idFuncioDeta + '"><td><div class="radio radio-success"><input type="radio" class="seleccionarResponsable" name="ChkFuncionariosResponsables[]" id="ChkFuncionariosResponsables' + idFuncioDeta + '" value="' + idFuncioDeta + '" data-id_responsable_dependencia="' + idDependenciaDestinatario + '" data-id_responsable_oficina="' + idOficinaDestinatario + '"><label for="ChkFuncionariosResponsables' + idFuncioDeta + '">R</label></div></td><td>' + nombreDestinatario + "</td><td>" + oficinaDestinatario + '</td><td><button class="borrar_destinatario btn btn-danger btn-sm btn-small" data-id="' + idFuncioDeta + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
    });

    //FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO
    $("body").on("change", ".seleccionarResponsable", function (event) {
        event.preventDefault();

        //let idResponsable = $(this).data('id_responsable_dependencia');
        let idResponsable = $(this).val();
        console.log(idResponsable);
        let IdDepen = $(this).data("id_responsable_dependencia");
        let IdOficina = $(this).data("id_responsable_oficina");
        let IncluirOficinaTRD = $("#incluir_oficina_trd").val();

        $("#id_responsable").val(idResponsable);
        $("#id_depen").val(IdDepen);
        $("#id_oficina").val(IdOficina);

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
            console.log("1");
            $("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_tickect.php?id_radica=" + $(this).data("id_radicado"));
        } else if ($("#tipo_impre_torulo").val() == 2) {
            $("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_documento.php?id_radica=" + $(this).data("id_radicado"));
            console.log("2");
        }

        $.ajax({
            url: "accionesVentanillaRecibidas.php",
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

    $("#BtnNuevoTerceroJuridico").click(function (e) {
        $.post("../../../varios/combo_Empresas.php", {}, function (data) {
            $("#multi").html(data);
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
        let idResponsable = $("#id_responsable").val();
        let totalDestinatarios = $("input[name='ChkFuncionariosResponsables[]']").length;

        if (totalDestinatarios === 0) {
            sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
            $("#BtnBuscarDestinatario").click();
        } else if (idResponsable == "") {
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
        $("#id_radicado").val($(this).data("id_radicado"));
    });

    $(document).on("click", ".ImprimirRotulo", function (event) {
        $("#id_radicado").val($(this).data("id_radicado"));
    });

    $("#id_depar_contac").change(function () {
        $("#id_depar_contac option:selected").each(function () {
            var idDepar = $(this).val();
            $.post(
                "../../../varios/combo_Municipios.php",
                {
                    idDepar: idDepar,
                },
                function (data) {
                    $("#id_muni_contac").html(data);
                }
            );
        });
    });

    $("#id_depar_juridico_empresa").change(function () {
        $("#id_depar_juridico_empresa option:selected").each(function () {
            var idDepar = $(this).val();
            $.post(
                "../../../varios/combo_Municipios.php",
                {
                    idDepar: idDepar,
                },
                function (data) {
                    $("#id_muni_juridico_empresa").html(data);
                }
            );
        });
    });

    $("#BtnBuscarDestinatarioNatural").click(function (e) {
        $("#TxtBusDestinaNaturales").focus();
    });

    $("#TxtBusDestinaNaturales").keyup(function (e) {
        if (e.which == 13) {
            if ($("#TxtBusDestinaNaturales").val() === "") {
                $("#DivAlertasDestinaNaturales").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta ingresar el criterio de busqueda" }, function () {});
                $("#TxtBusDestinaNaturales").focus();
            } else {
                $.ajax({
                    url: "../../../varios/listar_tercero_correspondencia.php",
                    type: "POST",
                    data: "criterio=" + $("#TxtBusDestinaNaturales").val(),
                    beforeSend: function () {
                        $("#DivAlertasDestinaNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj != 1) {
                            $("#DivAlertasDestinaNaturales").empty();
                            $("#DivDestinatarioNaturales").html(msj);
                        } else {
                            $("#DivAlertasDestinaNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> NO se encontraron resultados.</div>');
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasDestinaNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        }
    });

    //FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
    $(document).on("click", "#BtnLlevarTercero", function (event) {
        var IdEmpre = $(this).data("id_empre");

        $("#id_tercero").val($(this).data("id_tercero"));

        $("#cc_nit").val($(this).data("num_docu"));
        $("#remite_contacto").val($(this).data("nom_contac"));
        $("#remite_dir").val($(this).data("dir"));
        $("#remite_tel").val($(this).data("tel"));
        $("#remite_cel").val($(this).data("cel"));
        $("#remite_email").val($(this).data("email"));

        if (IdEmpre != "") {
            $("#remite_razo_soci").val($(this).data("razo_soci"));
            $("#DivOcultarTerceroRazoSoci").hide();
            $("#BtnCancelarTerceroNatural").click();
            $("#DivAlertasDestinaNaturales").empty();
        } else {
            $("#DivOcultarTerceroRazoSoci").show();
        }

        $("#BtnCancelarBusTercero").click();
    });

    $("#BtnReportCorrespondenRecibidaPorVencer").click(function () {
        var url = "../../../reportes/ventanilla/pendientes/por_vencer_recibidos_excel.php";
        window.open(url);
    });

    $("#BtnReportCorresRecibidaPorDigital").click(function () {
        var url = "../../../reportes/ventanilla/pendientes/por_digital_recibidos_excel.php";
        window.open(url);
    });

    $(document).on("click", "#BtnNotificarPorEmail", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $.ajax({
            url: "../../../varios/enviar_email.php",
            type: "POST",
            data: "accion=CORRESPONDENCIA_RECIVIDA&id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 4, mensaje: "La notificación de envio correctamente." }, function () {});
                } else {
                    $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                }
            },
            error: function (msj) {
                $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
            },
        });
    });
});
