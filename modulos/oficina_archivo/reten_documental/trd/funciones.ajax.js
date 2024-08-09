$(document).ready(function () {
    $("#BtnGuarda").click(function () {
        if ($("#id_depen").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la dependencia para de la TRD.</div>');
            $("#id_depen").focus();
        } else if ($("#id_serie").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Serie para la TRD.</div>');
            $("#id_serie").focus();
        } else if ($("#id_subserie").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el SubSerie para la TRD.</div>');
            $("#id_subserie").focus();
        } else if ($("#agForm").val() == 0 || $("#agForm").val() == "") {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el tiempo de AG para la TRD.</div>');
            $("#agForm").focus();
        } else if ($("#agForm").val() == 0 || $("#acForm").val() == "") {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el tiempo de AC para la TRD.</div>');
            $("#agForm").focus();
        } else if (!$("#ChkFormCT").is(":checked") && !$("#ChkFormE").is(":checked") && !$("#ChkFormDM").is(":checked") && !$("#ChkFormS").is(":checked")) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta establecer la disposición final para la TRD.</div>');
            $("#ChkFormCT").focus();
        } else {
            var formData = new FormData($("#FrmDatos")[0]);

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                        $("#acti").prop("checked", true);
                        $("#id_depen").change();
                    } else {
                        $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                },
            });
        }
    });

    $("#BtnEditarSubserie").click(function () {
        var NomSubSerie = $("#nombre_subserie").val();
        swal(
            {
                title: "¿Desea editar el registro con el nombre " + NomSubSerie + "?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: false,
            },

            function () {
                var TiposDocumentos = new Array();

                $("input[name='ChkTipoDoc[]']:checked").each(function () {
                    TiposDocumentos.push($(this).val());
                });

                var acti = $("#acti").prop("checked") ? 1 : 0;

                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=EDITAR_SUBSERIE&id_subserie=" + $("#edit_id_subserie").val() + "&TiposDocumentos=" + TiposDocumentos,
                    beforeSend: function () {
                        $("#DivAlertasGestionSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlertasGestionSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');

                            setTimeout(function () {
                                window.location.href = "index.php";
                            }, 300);
                        } else {
                            $("#DivAlertasGestionSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasGestionSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        );
    });

    $("#id_depen").change(function () {
        var idDepen = $(this).val();

        if ($("#incluir_oficina_trd").val() == 1) {
            $.post(
                "listar_trd.php",
                {
                    id_depen: $("#id_depen").val(),
                },
                function (data) {
                    $("#TblTRD tbody tr").each(function (index) {
                        var campo1, campo2, campo3;
                        $(this)
                            .children("td")
                            .each(function (index2) {
                                $(this).remove();
                            });
                    });

                    $("#TblTRD tr:last").after(data);
                }
            );
        } else if ($("#incluir_oficina_trd").val() == 2) {
            $.post(
                "../../../varios/combo_oficinas.php",
                {
                    idDepen: idDepen,
                },
                function (data) {
                    $("#id_oficina").html(data);
                }
            );
        }
    });

    $("#id_oficina").change(function () {
        $.post(
            "listar_trd.php",
            {
                id_depen: $("#id_depen").val(),
                id_oficina: $("#id_oficina").val(),
            },
            function (data) {
                $("#TblTRD tbody tr").each(function (index) {
                    var campo1, campo2, campo3;
                    $(this)
                        .children("td")
                        .each(function (index2) {
                            $(this).remove();
                        });
                });

                $("#TblTRD tr:last").after(data);
            }
        );
    });

    $(document).on("click", ".actiTRD", function (event) {
        var IdTRD = $(this).data("id_trd");
        var Acti = 0;
        if ($(this).is(":checked")) {
            Acti = 1;
        }

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=ACTIVAR_TRD&id_TRD=" + IdTRD + "&acti=" + Acti,
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("blur", "#Txtag", function (event) {
        var IdTRD = $(this).data("id_trd");

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_RETENCION_AG&id_TRD=" + IdTRD + "&agForm=" + $(this).val(),
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("blur", "#Txtac", function (event) {
        var IdTRD = $(this).data("id_trd");

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_RETENCION_AC&id_TRD=" + IdTRD + "&acForm=" + $(this).val(),
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", ".DispoFinal_ct", function (event) {
        var IdTRD = $(this).data("id_trd");
        var Acti = 0;
        if ($(this).is(":checked")) {
            Acti = 1;
        }

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_DISPO_FINAL_CT&id_TRD=" + IdTRD + "&ChkFormCT=" + Acti,
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", ".DispoFinal_e", function (event) {
        var IdTRD = $(this).data("id_trd");
        var Acti = 0;
        if ($(this).is(":checked")) {
            Acti = 1;
        }

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_DISPO_FINAL_E&id_TRD=" + IdTRD + "&ChkFormE=" + Acti,
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", ".DispoFinal_dm", function (event) {
        var IdTRD = $(this).data("id_trd");
        var Acti = 0;
        if ($(this).is(":checked")) {
            Acti = 1;
        }

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_DISPO_FINAL_DM&id_TRD=" + IdTRD + "&ChkFormDM=" + Acti,
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", ".DispoFinal_s", function (event) {
        var IdTRD = $(this).data("id_trd");
        var Acti = 0;
        if ($(this).is(":checked")) {
            Acti = 1;
        }

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=GESTIONAR_DISPO_FINAL_S&id_TRD=" + IdTRD + "&ChkFormS=" + Acti,
            beforeSend: function () {
                $("#DivAlertaSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertaSubseries").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                } else {
                    $("#DivAlertaSubseries").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                }
            },
            error: function (msj) {
                $("#DivAlertaSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnBuscarSubserie", function (event) {
        var IdSubSerie = $(this).data("id_subserie");
        $("#DivNomSubserie").html($(this).data("nom_subserie"));
        $("#nombre_subserie").html($(this).data("nom_subserie"));
        $("#edit_id_subserie").val($(this).data("id_subserie"));

        $.ajax({
            url: "listar_sub_serie.php",
            type: "POST",
            data: "id=" + IdSubSerie,
            beforeSend: function () {
                $("#DivAlertasGestionSubseries").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#DivAlertasGestionSubseries").empty();
                $("#DivGestionSubseries").html(msj);
            },
            error: function (msj) {
                $("#DivAlertasGestionSubseries").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", ".levar_tipo_documento", function (event) {
        event.preventDefault();
        var IdTipo = $(this).data("id_tipo_documento");
        $("#TiposDocumentales tr:last").after('<tr id="TrTipoDocumento' + $(this).val() + '"><td><div class="checkbox check-success"><input name="ChkTipoDoc[]" id="ChkTipoDoc' + $(this).data("id_tipo_documento") + '" type="checkbox" value="' + $(this).data("id_tipo_documento") + '" checked><label for="ChkTipoDoc' + $(this).data("id_tipo_documento") + '"></label></div></td><td>' + $(this).data("nom_tipo_documento") + '</td><td><button class="borrar_tipo_documental btn btn-danger btn-xs btn-mini" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
    });

    //FUNCION PARA BORRAR UN TIPO DOCUMENTAL
    $(document).on("click", ".borrar_tipo_documental", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
    });
});
