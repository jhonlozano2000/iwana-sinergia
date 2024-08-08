$(document).ready(function () {
    $("#BtnNuevoExpediente").attr("disabled", true);
    $("#BtnSubirArchivo").attr("disabled", true);

    $("#BtnGuardar").click(function (e) {
        e.preventDefault();

        setTimeout(function () {
            if ($("#id_serie").val() == 0) {
                $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo la serie</div>');
                $("#id_serie").focus();
            } else if ($("#id_sub_serie").val() == 0) {
                $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la sub serie.</div>');
                $("#id_sub_serie").focus();
            } else if ($("#codigo").val() == 0) {
                $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el codígo del expediente.</div>');
                $("#codigo").focus();
            } else if ($("#titulo").val() == 0) {
                $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el nombre del expediente.</div>');
                $("#titulo").focus();
            } else {
                var formData = new FormData($("#FrmDatos")[0]);

                $.ajax({
                    url: "acciones_expedientes.ajax.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
                    },
                    success: function (msj) {
                        var Elemento = msj.split("-");

                        if (Elemento[0] == 1) {
                            var IdDigital = Elemento[1];
                            var IdTomo = Elemento[2];

                            $("#id_digital").val(IdDigital);

                            $("#BtnNuevoExpediente").attr("disabled", false);
                            $("#BtnGuardar").attr("disabled", true);
                            $("#BtnSubirArchivo").attr("disabled", false);
                            $("#BtnNuevoTomo").attr("disabled", false);
                            $("#accion").val("SUBIR_ARCHIVOS");

                            $.post("combo_tomos.php", { id_digital: IdDigital }, function (data) {
                                $("#id_tomo").html(data);
                                $('#id_tomo > option[value="' + IdTomo + '"]').attr("selected", true);
                            });

                            $.post("listar_tipos_documentos.php", { id_digital: $("#id_digital").val(), id_depen: $("#id_depen").val(), id_serie: $("#id_serie").val(), id_sub_serie: $("#id_subserie").val() }, function (data) {
                                $("#DivTiposDocumentales").html(data);
                            });

                            $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
                            $("#id_digital").val(Elemento[1]);
                        } else {
                            $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + ".</div>");
                        }
                    },
                    error: function () {
                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
                    },
                });
            }
        }, 500);
        return false;
    });

    $("#BtnSubirArchivo").click(function (e) {
        e.preventDefault();

        setTimeout(function () {
            var formData = new FormData($("#FrmDatos")[0]);

            $.ajax({
                url: "acciones_expedientes.ajax.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button><h4><i class="icon fa fa-check"></i> Muy bien!!!...</h4>El registro se almaceno correctamente.</div>');

                        $.post(
                            "listar_tipos_documentos.php",
                            {
                                id_digital: $("#id_digital").val(),
                                id_depen: $("#id_depen").val(),
                                id_serie: $("#id_serie").val(),
                                id_sub_serie: $("#id_subserie").val(),
                            },
                            function (data) {
                                $("#DivTiposDocumentales").html(data);
                            }
                        );
                    } else {
                        $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + ".</div>");
                    }
                },
                error: function () {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
                },
            });
        }, 500);
        return false;
    });

    $("#BtnNuevoTomo").click(function (e) {
        e.preventDefault();
        swal(
            {
                title: "Vas a crear un nuevo tomo?",
                text: "Confirma que deseas crear un nuevo tomo!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#468847",
                confirmButtonText: "¡si, crear tómo!",
                closeOnConfirm: false,
            },

            function (isConfirm) {
                if (isConfirm) {
                    if ($("#id_digital").val() == "") {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Vas a crear un nuevo tómo, por lo tanto el sistema creara el tómo auntomaticamente." }, function () {});
                    } else {
                        $.ajax({
                            url: "acciones_expedientes.ajax.php",
                            type: "POST",
                            data: "accion=NUEVO_TOMO&id_digital=" + $("#id_digital").val(),
                            beforeSend: function () {
                                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
                            },
                            success: function (msj) {
                                var Elemento = msj.split("-");

                                if (Elemento[0] == 1) {
                                    var IdTomo = Elemento[1];

                                    $.post(
                                        "combo_tomos.php",
                                        {
                                            id_digital: $("#id_digital").val(),
                                        },
                                        function (data) {
                                            $("#id_tomo").html(data);
                                            $('#id_tomo > option[value="' + IdTomo + '"]').attr("selected", true);
                                        }
                                    );

                                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El tomo se creo correctamente. </div>');

                                    swal("Deleted!", "Tomo creado correctamente.", "success");
                                } else {
                                    $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                                }
                            },
                            error: function () {
                                $("#DivAlertas").load('<button class="close" data-dismiss="alert"></button><a href="#" class="link">Upsss</a><button class="btn btn-danger btn-sm btn-small pull-right" type="button">' + msj + ".</button>");
                            },
                        });
                    }
                }
            }
        );
    });

    $("#BtnNuevoExpediente").click(function (e) {
        $("#BtnNuevoExpediente").attr("disabled", false);
        $("#BtnGuardar").attr("disabled", true);
        $("#BtnSubirArchivo").attr("disabled", false);
        $("#BtnNuevoTomo").attr("disabled", false);
        $("#accion").val("NUEVO_EXPEDIENTE");
    });

    $("#BtnBuscarExpediente").click(function (e) {
        $("#TxtBusExpediente").focus();
    });

    //FUNCION PARA BUSCAR EL TERCERO NATURAL
    $("#TxtBusExpediente").keyup(function (e) {
        if (e.which == 13) {
            if ($("#TxtBusExpediente").val() === "") {
                $("#DivAlertasExpedientes").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta ingresar el criterio de busqueda</div>');
                $("#TxtBusExpediente").focus();
            } else {
                $.ajax({
                    url: "listar_expedientes.php",
                    type: "POST",
                    data: "criterio=" + $("#TxtBusExpediente").val() + "&incluir_oficina_trd=" + $("#incluir_oficina_trd").val(),
                    beforeSend: function () {
                        $("#DivAlertasExpedientes").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
                    },
                    success: function (msj) {
                        if (msj != 1) {
                            $("#DivListarExpedientes").html(msj);
                            $("#DivAlertasExpedientes").empty();
                        } else {
                            $("#DivAlertasExpedientes").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                        }
                    },
                    error: function () {
                        $("#DivAlertasExpedientes").load('<button class="close" data-dismiss="alert"></button><a href="#" class="link">Upsss</a><button class="btn btn-danger btn-sm btn-small pull-right" type="button">' + msj + ".</button>");
                    },
                });
            }
        }
    });

    $("#id_depen").change(function () {
        var IdDepen = $("#id_depen").val();
        var IdOficina = $("#id_oficina").val();
        var IncluirOficinaTRD = $("#incluir_oficina_trd").val();

        if ($("#incluir_oficina_trd").val() == 1) {
            $.post(
                "../../../varios/combo_series.php",
                {
                    id_depen: IdDepen,
                    id_oficina: "",
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    $("#id_serie").html(data);
                }
            );
        } else if ($("#incluir_oficina_trd").val() == 2) {
            $.post(
                "../../../varios/combo_oficinas.php",
                {
                    idDepen: IdDepen,
                    id_oficina: IdOficina,
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    console.log(data);
                    $("#id_oficina").html(data);
                }
            );
        }
    });

    $("#id_oficina").change(function () {
        var IdDepen = $("#id_depen").val();
        var IdOficina = $("#id_oficina").val();
        var IncluirOficinaTRD = $("#incluir_oficina_trd").val();

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
                alert(data);
                $("#id_serie").html(data);
            }
        );
    });

    $("#id_serie").change(function () {
        if ($("#id_serie").val() != 0) {
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
        }
    });

    $("#id_subserie").change(function () {
        if ($("#id_subserie").val() != 0) {
            var id_serie = $("#id_serie").val();
            var id_sub_serie = $("#id_subserie").val();

            $.post(
                "listar_tipos_documentos.php",
                {
                    id_depen: $("#id_depen").val(),
                    id_serie: id_serie,
                    id_sub_serie: id_sub_serie,
                },
                function (data) {
                    $("#DivTiposDocumentales").html(data);
                }
            );
        }
    });

    //FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
    $(document).on("click", "#BtnLlevarExpediente", function (event) {
        var IdDigital = $(this).data("id_digital");
        var IdDepen = $(this).data("id_depen");
        var IdOficina = $(this).data("id_oficina");
        var IdSerie = $(this).data("id_serie");
        var IdSubSerie = $(this).data("id_subserie");
        var IncluirOficinaTRD = $("#incluir_oficina_trd").val();

        $("#id_digital").val($(this).data("id_digital"));
        $('#id_depen > option[value="' + IdDepen + '"]').attr("selected", true);

        if ($("#incluir_oficina_trd").val() == 1) {
            $.post(
                "../../../varios/combo_series.php",
                {
                    id_depen: IdDepen,
                    id_oficina: IdOficina,
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    $("#id_serie").html(data);
                    $('#id_serie > option[value="' + IdSerie + '"]').attr("selected", true);
                }
            );

            $.post(
                "../../../varios/combo_sub_series.php",
                {
                    id_serie: IdSerie,
                    id_depen: IdDepen,
                },
                function (data) {
                    $("#id_subserie").html(data);
                    $('#id_subserie > option[value="' + IdSubSerie + '"]').attr("selected", true);
                }
            );

            $.post(
                "listar_tipos_documentos.php",
                {
                    id_digital: $("#id_digital").val(),
                    id_depen: IdDepen,
                    id_serie: IdSerie,
                    id_sub_serie: IdSubSerie,
                },
                function (data) {
                    $("#DivTiposDocumentales").html(data);
                }
            );
        } else if ($("#incluir_oficina_trd").val() == 2) {
            $.post(
                "../../../varios/combo_oficinas.php",
                {
                    idDepen: IdDepen,
                    id_oficina: IdOficina,
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    $("#id_oficina").html(data);
                    $('#id_oficina > option[value="' + IdOficina + '"]').attr("selected", true);
                }
            );

            $.post(
                "../../../varios/combo_series.php",
                {
                    id_depen: IdDepen,
                    id_oficina: IdOficina,
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    $("#id_serie").html(data);
                    $('#id_serie > option[value="' + IdSerie + '"]').attr("selected", true);
                }
            );

            $.post(
                "../../../varios/combo_sub_series.php",
                {
                    id_depen: IdDepen,
                    id_oficina: IdOficina,
                    id_serie: IdSerie,
                    IncluirOficinaTRD: IncluirOficinaTRD,
                },
                function (data) {
                    $("#id_subserie").html(data);
                    $('#id_subserie > option[value="' + IdSubSerie + '"]').attr("selected", true);
                }
            );

            $.post(
                "listar_tipos_documentos.php",
                {
                    id_digital: $("#id_digital").val(),
                    id_depen: IdDepen,
                    id_oficina: IdOficina,
                    id_serie: IdSerie,
                    id_sub_serie: IdSubSerie,
                },
                function (data) {
                    $("#DivTiposDocumentales").html(data);
                }
            );
        }

        $.post(
            "combo_tomos.php",
            {
                id_digital: IdDigital,
            },
            function (data) {
                $("#id_tomo").html(data);
                $("#id_tomo_ver_tipo_documento").html(data);
                $("#id_tomo_ver_archivos_ComoUnTodo").html(data);
            }
        );

        $("#id_digital").val($(this).data("id_digital"));
        $("#codigo").val($(this).data("codigo"));
        $("#titulo").val($(this).data("titulo"));
        $("#fec_ini").val($(this).data("fec_ini"));
        $("#fec_fin").val($(this).data("fec_fin"));
        $("#criterio1").val($(this).data("criterio1"));
        $("#criterio2").val($(this).data("criterio2"));
        $("#criterio3").val($(this).data("criterio3"));
        $("#deposito").val($(this).data("deposito"));
        $("#caja").val($(this).data("caja"));
        $("#carpeta").val($(this).data("carpeta"));
        $("#folios").val($(this).data("folios"));
        $("#acti").val($(this).data("acti"));

        $("#BtnNuevoExpediente").attr("disabled", false);
        $("#BtnGuardar").attr("disabled", true);
        $("#BtnSubirArchivo").attr("disabled", false);
        $("#BtnNuevoTomo").attr("disabled", false);
        $("#accion").val("SUBIR_ARCHIVOS");
    });

    $(document).on("click", "#BtnVerExpediente", function (event) {
        var IdDigital = $("#id_digital").val();
        var id_serie = $("#id_serie").val();
        var id_sub_serie = $("#id_subserie").val();

        $("#LabelExpedientes").html("Código: " + $("#codigo").val() + ", Titulo: " + $("#titulo").val() + ".");

        $.ajax({
            url: "ver_expediente_tipo_documental.php",
            type: "POST",
            data: "id_depen=" + $("#id_depen").val() + "&id_serie=" + id_serie + "&id_sub_serie=" + id_sub_serie,
            beforeSend: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
            },
            success: function (msj) {
                if (msj != 1) {
                    $("#DivVerTiposDocumentales").html(msj);
                } else {
                    $("#DivAlertasVerExpediente").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                }
            },
            error: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
            },
        });

        $.ajax({
            url: "ver_expediente_como_un_todo.php",
            type: "POST",
            data: "id_digital=" + IdDigital + "&id_tomo_ver_archivos_ComoUnTodo=" + $("#id_tomo_ver_archivos_ComoUnTodo").val(),
            beforeSend: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
            },
            success: function (msj) {
                if (msj != 1) {
                    $("#DivListarArchivosDigitales_Como_Un_Todo").html(msj);
                    $("#DivAlertasVerExpediente").empty();
                } else {
                    $("#DivAlertasVerExpediente").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                }
            },
            error: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
            },
        });
    });

    $(document).on("click", "#BtnVerArchivos", function (event) {
        var IdDigital = $("#id_digital").val();
        var IdDTipoDocu = $(this).data("id_tipodoc");
        var IdTomo = $("#id_tomo_ver_tipo_documento").val();
        var VerTipo = $(this).data("ver_tipo");

        $.ajax({
            url: "ver_Archivos_por_tipo_documental.php",
            type: "POST",
            data: "id_digital=" + IdDigital + "&id_tipodoc=" + IdDTipoDocu + "&id_tomo_ver_tipo_documento=" + IdTomo + "&ver_tipo=" + VerTipo,
            beforeSend: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
            },
            success: function (msj) {
                if (msj != 1) {
                    $("#DivListarArchivosDigitales_Expediente").html(msj);
                    $("#DivAlertasVerExpediente").empty();
                } else {
                    $("#DivAlertasVerExpediente").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                }
            },
            error: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
            },
        });
    });

    $(document).on("change", "#id_tomo_ver_tipo_documento", function (event) {
        var IdDigital = $("#id_digital").val();
        var IdDTipoDocu = $("#id_tipo_docu").val();
        var IdTomo = $("#id_tomo_ver_tipo_documento").val();

        $.ajax({
            url: "Ver_Archivos.php",
            type: "POST",
            data: "id_digital=" + IdDigital + "&id_tipodoc=" + IdDTipoDocu + "&id_tomo=" + IdTomo,
            beforeSend: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" />Enviando información...</div>');
            },
            success: function (msj) {
                if (msj != 1) {
                    $("#DivListarArchivosDigitales_Expediente").html(msj);
                    $("#DivAlertasVerExpediente").empty();
                } else {
                    $("#DivAlertasVerExpediente").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                }
            },
            error: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
            },
        });
    });

    $(document).on("click", "#BtnDescargaArchivo", function (event) {
        var IdDigital = $(this).data("id_digital");
        var IdArchivo = $(this).data("id_archivo");
        var IdRuta = $(this).data("id_ruta");
        var Archivo = $(this).data("archivo");
        var IdTomo = $(this).data("id_tomo");

        $.ajax({
            url: "../../../varios/ftp.acciones.php",
            type: "POST",
            data: "accion=DESCARGAR_ARCHIVO_EXPEDIENTE_DIGITAL_TRD&id_digital=" + IdDigital + "&id_archivo=" + IdArchivo + "&id_ruta=" + IdRuta + "&archivo=" + Archivo + "&id_tomo=" + IdTomo,
            beforeSend: function () {
                $("#DivAlertasVerExpediente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#DivAlertasVerExpediente").empty();

                var Elemento = msj.split("-");

                if (Elemento[0] == 1) {
                    window.open("../../../../archivos/temp/expedientes/" + IdDigital + "/" + Elemento[1] + "/" + Archivo, "_blank");
                } else {
                    $("#DivAlertasVerExpediente").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + "</div>");
                }
            },
            error: function (error) {
                sweetAlert("Oops...", error, "error");
            },
        });
    });

    $(document).on("click", "#BtnEliminaArchivo", function (event) {
        var IdDigital = $(this).data("id_digital");
        var IdArchivo = $(this).data("id_archivo");
        var IdRuta = $(this).data("id_ruta");
        var Archivo = $(this).data("archivo");
        var TipoArchivo = $(this).data("tipo_archivo");

        $.ajax({
            url: "acciones_expedientes.ajax.php",
            type: "POST",
            data: "accion=ELIMINAR_DIGITAL&id_digital=" + IdDigital + "&id_archivo=" + IdArchivo + "&id_ruta=" + IdRuta + "&archivo=" + Archivo + "&tipo_archivo=" + TipoArchivo,
            beforeSend: function () {
                $("#DivAlertasDigitales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertasDigitales").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');
                    $("#TrArchivo" + IdArchivo).remove();
                }
            },
            error: function (error) {
                sweetAlert("Oops...", error, "error");
            },
        });
    });
});
