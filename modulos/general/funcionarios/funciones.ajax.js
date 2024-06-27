$(document).ready(function () {
    $("#cod_funcio").focus();

    $("#BtnGuardar").click(function () {
        if ($("#cod_funcio").val() == "") {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el número de documento del funcionario.</div>');
            $("#cod_funcio").focus();
        } else if ($("#nom_funcio").val() == "") {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del funcionario.</div>');
            $("#nom_funcio").focus();
        } else if ($("#ape_funcio").val() == "") {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta los apellidos del funcionario.</div>');
            $("#ape_funcio").focus();
        } else if ($("#genero").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
            $("#genero").focus();
        } else if ($("#id_depar").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el departamento de recidencia del funcionario.</div>');
            $("#id_depar").focus();
        } else if ($("#id_muni").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el municipio de recidencia del funcionario.</div>');
            $("#id_muni").focus();
        } else if ($("#id_depen").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la dependencia a la cual pertenece el funcionario.</div>');
            $("#id_depen").focus();
        } else if ($("#id_oficina").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la oficina del funcionario.</div>');
            $("#id_oficina").focus();
        } else if ($("#id_cargo").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el cardo del funcionario.</div>');
            $("#id_cargo").focus();
        } else {
            var JefeDepen = $("#jefe_dependencia").prop("checked") ? 1 : 0;
            var PropiePrinci = $("#propie_princi").prop("checked") ? 1 : 0;
            var CreaExpedien = $("#crea_expedien").prop("checked") ? 1 : 0;
            var JefeOficina = $("#jefe_oficina").prop("checked") ? 1 : 0;
            var PuedeFirmar = $("#puede_firmar").prop("checked") ? 1 : 0;
            var acti = $("#acti").prop("checked") ? 1 : 0;

            var ChkTRD = new Array();

            $("input[name='ChkTRD[]']:checked").each(function () {
                ChkTRD.push($(this).val());
            });

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data: "accion=INSERTAR&id_muni=" + $("#id_muni").val() + "&id_depar=" + $("#id_depar").val() + "&propie_princi=" + PropiePrinci + "&jefe_dependencia=" + JefeDepen + "&jefe_oficina=" + JefeOficina + "&crea_expedien=" + CreaExpedien + "&puede_firmar=" + PuedeFirmar + "&cod_funcio=" + $("#cod_funcio").val() + "&nom_funcio=" + $("#nom_funcio").val() + "&ape_funcio=" + $("#ape_funcio").val() + "&genero=" + $("#genero").val() + "&dir=" + $("#dir").val() + "&tel=" + $("#tel").val() + "&cel=" + $("#cel").val() + "&email=" + $("#email").val() + "&observa=" + $("#observa").val() + "&firma=" + $("#firma").val() + "&id_depen=" + $("#id_depen").val() + "&id_oficina=" + $("#id_oficina").val() + "&id_cargo=" + $("#id_cargo").val() + "&acti=" + acti + "&ChkTRD=" + ChkTRD,
                beforeSend: function () {
                    $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
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

    $("#BtnRegresar").click(function () {
        setTimeout(function () {
            window.location.href = "index.php";
        });
    });

    $("#BtnEditar").click(function () {
        swal(
            {
                title: "¿Desea editar el registro: " + $("#nom_funcio").val() + " " + $("#ape_funcio").val() + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Editar!",
                closeOnConfirm: false,
            },

            function () {
                if ($("#cod_funcio").val() == "") {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el número de documento del funcionario.</div>');
                    $("#cod_funcio").focus();
                } else if ($("#nom_funcio").val() == "") {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del funcionario.</div>');
                    $("#nom_funcio").focus();
                } else if ($("#ape_funcio").val() == "") {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta los apellidos del funcionario.</div>');
                    $("#ape_funcio").focus();
                } else if ($("#genero").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
                    $("#genero").focus();
                } else if ($("#id_depar").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el departamento de recidencia del funcionario.</div>');
                    $("#id_depar").focus();
                } else if ($("#id_muni").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el municipio de recidencia del funcionario.</div>');
                    $("#id_muni").focus();
                } else if ($("#id_depen").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la dependencia a la cual pertenece el funcionario.</div>');
                    $("#id_depen").focus();
                } else if ($("#id_oficina").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la oficina del funcionario.</div>');
                    $("#id_oficina").focus();
                } else if ($("#id_cargo").val() == 0) {
                    $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el cardo del funcionario.</div>');
                    $("#id_cargo").focus();
                } else {
                    var JefeDepen = $("#jefe_dependencia").prop("checked") ? 1 : 0;
                    var PropiePrinci = $("#propie_princi").prop("checked") ? 1 : 0;
                    var CreaExpedien = $("#crea_expedien").prop("checked") ? 1 : 0;
                    var JefeOficina = $("#jefe_oficina").prop("checked") ? 1 : 0;
                    var PuedeFirmar = $("#puede_firmar").prop("checked") ? 1 : 0;
                    var acti = $("#acti").prop("checked") ? 1 : 0;
                    var ChkTRD = new Array();
                    console.log("Okkkkkkkk");
                    $("input[name='ChkTRD[]']:checked").each(function () {
                        ChkTRD.push($(this).val());
                    });

                    $.ajax({
                        url: "acciones.ajax.php",
                        type: "POST",
                        data:
                            "accion=EDITAR&id_funcio=" +
                            $("#id_funcio").val() +
                            "&id_funcio_deta=" +
                            $("#id_funcio_deta").val() +
                            "&id_muni=" +
                            $("#id_muni").val() +
                            "&id_depar=" +
                            $("#id_depar").val() +
                            "&propie_princi=" +
                            PropiePrinci +
                            "&jefe_dependencia=" +
                            JefeDepen +
                            "&jefe_oficina=" +
                            JefeOficina +
                            "&crea_expedien=" +
                            CreaExpedien +
                            "&puede_firmar=" +
                            PuedeFirmar +
                            "&cod_funcio=" +
                            $("#cod_funcio").val() +
                            "&nom_funcio=" +
                            $("#nom_funcio").val() +
                            "&ape_funcio=" +
                            $("#ape_funcio").val() +
                            "&genero=" +
                            $("#genero").val() +
                            "&dir=" +
                            $("#dir").val() +
                            "&tel=" +
                            $("#tel").val() +
                            "&cel=" +
                            $("#cel").val() +
                            "&email=" +
                            $("#email").val() +
                            "&observa=" +
                            $("#observa").val() +
                            "&firma=" +
                            $("#firma").val() +
                            "&id_depen=" +
                            $("#id_depen").val() +
                            "&id_oficina=" +
                            $("#id_oficina").val() +
                            "&id_cargo=" +
                            $("#id_cargo").val() +
                            "&acti=" +
                            acti +
                            "&ChkTRD=" +
                            ChkTRD,
                        beforeSend: function () {
                            $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                        },
                        success: function (msj) {
                            if (msj == 1) {
                                $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                                setTimeout(function () {
                                    window.location.href = "index.php";
                                }, 100);
                            } else {
                                $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                            }
                        },
                        error: function (msj) {
                            $("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                        },
                    });
                }
            }
        );
    });

    $(document).on("click", "#BtnEliminar", function (event) {
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var IdFuncio = $(this).data("id_funcio");
        swal(
            {
                title: "¿Desea eliminar el registro con el nombre " + $(this).data("nom") + "?",
                type: "error",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡si, eliminar!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=ELIMINAR&id_funcio_deta=" + IdFuncioDeta + "&id_funcio=" + IdFuncio,
                    success: function (msj) {
                        if (msj == 1) {
                            $("#TrDatos" + IdFuncioDeta).remove();
                            swal("¡Eliminado!", "El registro " + $(this).data("nom") + " se elimino correctamente!.", "success");
                        } else {
                            swal("Error", msj, "error");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                    },
                });
            }
        );
    });

    $(document).on("click", ".acti", function (event) {
        var IdFuncioDeta = $(this).data("id_funcio_deta");
        var IdFuncio = $(this).data("id_funcio");
        var Acti = 0;
        var Accion = "";
        var Boton = "";
        if ($(this).is(":checked")) {
            Acti = 1;
            Accion = "activar";
            Boton = "#468847";
        } else {
            Accion = "inactivar";
            Boton = "#DD6B55";
        }

        swal(
            {
                title: "¿Desea " + Accion + " el funcionario con el nombre " + $(this).data("funcion") + "?",
                type: "success",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: Boton,
                confirmButtonText: "¡si, " + Accion + "!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: "accion=ACTIVAR&id_funcio_deta=" + IdFuncioDeta + "&id_funcio=" + IdFuncio + "&acti=" + Acti,
                    beforeSend: function () {
                        $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                            swal("¡" + Accion + "!", "El funcionario " + $(this).data("funcion") + " ha sido " + Accion + "!.", "success");
                        } else {
                            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        );
    });

    $("#id_depen").change(function () {
        $("#id_depen option:selected").each(function () {
            var idDepen = $(this).val();
            $.post(
                "../../varios/combo_oficinas.php",
                {
                    idDepen: idDepen,
                },
                function (data) {
                    $("#id_oficina").html(data);
                }
            );

            $.post(
                "../../varios/combo_cargos.php",
                {
                    idDepen: idDepen,
                },
                function (data) {
                    $("#id_cargo").html(data);
                }
            );

            $.post(
                "listar_trd.php",
                {
                    idDepen: idDepen,
                },
                function (data) {
                    $("#DivMostrarTRD").html(data);
                }
            );
        });
    });

    $("#id_depar").change(function () {
        $("#id_depar option:selected").each(function () {
            var idDepar = $(this).val();
            $.post(
                "../../varios/combo_Municipios.php",
                {
                    idDepar: idDepar,
                },
                function (data) {
                    $("#id_muni").html(data);
                }
            );
        });
    });
});
