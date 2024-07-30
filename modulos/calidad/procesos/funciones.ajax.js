$(document).ready(function () {
    $("#cod_proce").focus();

    $("#BtnGuardar").click(function () {
        if ($("#id_depen").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia a la cual corresponde el proceso" }, function () {});
            $("#id_depen").focus();
        } else if ($("#cod_proce").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código del proceso" }, function () {});
            $("#cod_proce").focus();
        } else if ($("#nom_proce").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del proceso" }, function () {});
            $("#nom_proce").focus();
        } else {
            var acti = $("#acti").prop("checked") ? true : false;

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                // Form data
                //datos del formulario
                data: "accion=INSERTAR&id_depen=" + $("#id_depen").val() + "&cod_proce=" + $("#cod_proce").val() + "&nom_proce=" + $("#nom_proce").val() + "&acti=" + acti,
                beforeSend: function () {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información...", Imagen: "../../../public/assets/img/loading.gif" }, function () {});
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#nom_proce").val("");
                        $("#cod_proce").focus();
                        $("#acti").prop("checked", true);

                        /*
						setTimeout(function(){
							window.location.href = "index.php";
						}, 100);
						*/
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
                title: "¿Desea editar el registro: " + $("#nom_proce").val() + "?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: false,
            },

            function () {
                var formData = new FormData($("#FrmDatos")[0]);

                $.ajax({
                    url: "acciones.ajax.php",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
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
                    data: "accion=ELIMINAR&procesos_id=" + Id,
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
                    data: "accion=ACTIVAR_INACTIVAR&id_proce=" + Id + "&acti=" + Acti,
                    beforeSend: function () {
                        $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                            swal("¡" + Accion + "!", "El registro " + nom + " ha sido " + Accion + "!.", "success");
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
