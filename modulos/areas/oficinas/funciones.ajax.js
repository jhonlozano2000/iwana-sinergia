$(document).ready(function () {
    $("#cod_oficina").focus();

    $("#BtnGuardar").click(function () {
        if ($("#id_depen").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia a la cual corresponde la oficina" }, function () {});
            $("#id_depen").focus();
        } else if ($("#cod_oficina").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código de la oficina" }, function () {});
            $("#cod_oficina").focus();
        } else if ($("#cod_corres").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código de correspondencia de la oficina" }, function () {});
            $("#cod_corres").focus();
        } else if ($("#nom_oficina").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre de la oficina" }, function () {});
            $("#nom_oficina").focus();
        } else {
            var acti = $("#acti").prop("checked") ? true : false;

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                // Form data
                //datos del formulario
                data: "accion=Insertar&id_depen=" + $("#id_depen").val() + "&cod_oficina=" + $("#cod_oficina").val() + "&cod_corres=" + $("#cod_corres").val() + "&nom_oficina=" + $("#nom_oficina").val() + "&observa=" + $("#observa").val() + "&acti=" + acti,
                beforeSend: function () {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información...", Imagen: "../../../public/assets/img/loading.gif" }, function () {});
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#cod_corres").focus();
                        $("#cod_corres").val("");
                        $("#cod_oficina").val("");
                        $("#nom_oficina").val("");
                        $("#observa").val("");
                        $("#acti").prop("checked", true);
                    } else {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function () {
                    $("#DivAlerta").load("../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución" }, function () {});
                },
            });
        }
        return false;
    });

    $("#BtnRegresar").click(function () {
        setTimeout(function () {
            window.location.href = "index.php";
        });
    });

    /**=============================================================================
     *
     *	función para editar
     *
     *===========================================================================**/
    $("#BtnEditar").click(function () {
        swal(
            {
                title: "¿Desea editar el registro: " + $("#nom_oficina").val() + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Editar!",
                closeOnConfirm: false,
            },

            function () {
                if ($("#id_depen").val() == 0) {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia a la cual corresponde la oficina" }, function () {});
                    $("#id_depen").focus();
                } else if ($("#cod_oficina").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código de la oficina" }, function () {});
                    $("#cod_oficina").focus();
                } else if ($("#cod_corres").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código de correspondencia de la oficina" }, function () {});
                    $("#cod_corres").focus();
                } else if ($("#nom_oficina").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre de la oficina" }, function () {});
                    $("#nom_oficina").focus();
                } else {
                    var acti = $("#acti").prop("checked") ? true : false;

                    $.ajax({
                        url: "acciones.ajax.php",
                        type: "POST",
                        data: "accion=Editar&id_oficina=" + $("#id_oficina").val() + "&id_depen=" + $("#id_depen").val() + "&cod_oficina=" + $("#cod_oficina").val() + "&cod_corres=" + $("#cod_corres").val() + "&nom_oficina=" + $("#nom_oficina").val() + "&observa=" + $("#observa").val() + "&acti=" + acti,
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

    /**=============================================================================
     *
     *	función para eliminar
     *
     *===========================================================================**/
    $(document).on("click", "#BtnEliminar", function (event) {
        var Id = $(this).data("id");
        var Nom = $(this).data("nom");

        swal(
            {
                title: "¿Desea eliminar el registro con el nombre " + Nom + "?",
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
                    data: "accion=ELIMINAR&id_oficina=" + Id,
                    success: function (msj) {
                        if (msj == 1) {
                            $("#TrDatos" + Id).remove();
                            swal("¡Eliminado!", "El registro " + Nom + " se elimino correctamente!.", "success");
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
        var Id = $(this).data("id");
        var Nom = $(this).data("nom");
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
                title: "¿Desea " + Accion + " el registro con el nombre " + Nom + "?",
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
                    data: "accion=ACTIVAR&id_oficina=" + Id + "&acti=" + Acti,
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
});
