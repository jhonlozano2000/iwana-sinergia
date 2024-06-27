$(document).ready(function () {
    $("#login").focus();

    $("#BtnGuardarUsuario").click(function () {
        if ($("#login").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el Login del usuario." }, function () {});
            $("#login").focus();
        } else if ($("#contra").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta la contraseña del usuario." }, function () {});
            $("#contra").focus();
        } else if (!$('input[name="ChkPerfiles[]"]').is(":checked")) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Para poder crear el usuario debes establecer al menos un perfil." }, function () {});
            $("#contra").focus();
        } else {
            var formData = new FormData($("#FrmDatos")[0]);

            $.ajax({
                url: "accionesUsuarios.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        setTimeout(function () {
                            window.location.href = "index.php";
                        }, 100);
                    } else {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
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

    $("#BtnEditarUsuario").click(function () {
        swal(
            {
                title: "¿Desea editar el Usuario: " + $("#login").val() + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Si, Editar!",
                closeOnConfirm: false,
            },

            function () {
                if ($("#login").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el Login del usuario." }, function () {});
                    $("#login").focus();
                } else if ($("#cod_funcio").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el número de documento del usuario." }, function () {});
                    $("#cod_funcio").focus();
                } else if ($("#nom_funcio").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta los nombres del usuario." }, function () {});
                    $("#nom_funcio").focus();
                } else if ($("#ape_funcio").val() == "") {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta los apellidos del usuario." }, function () {});
                    $("#ape_funcio").focus();
                } else {
                    var formData = new FormData($("#FrmDatos")[0]);

                    $.ajax({
                        url: "accionesUsuarios.ajax.php",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                        },
                        success: function (msj) {
                            if (msj == 1) {
                                $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se actualizo correctamente" }, function () {});
                                setTimeout(function () {
                                    window.location.href = "index.php";
                                }, 100);
                            } else {
                                $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                            }
                        },
                        error: function (msj) {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                        },
                    });
                }
                return false;
            }
        );
    });

    $(document).on("click", "#BtnEliminarUsuario", function (event) {
        var Id = $(this).data("id");
        swal(
            {
                title: "¿Desea eliminar el registro con el nombre " + $(this).data("nom") + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Eliminar!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesUsuarios.ajax.php",
                    type: "POST",
                    data: "accion=ELIMINAR&id_usua=" + $("#id_usua").val(),
                    beforeSend: function () {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se elimino correctamente" }, function () {});
                            $("#TrDatos" + Id).remove();
                            swal("¡Eliminado!", "El registro " + Nom + " se elimino correctamente!.", "success");
                        } else {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                        }
                    },
                    error: function (msj) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                    },
                });
            }
        );
    });

    $(document).on("click", ".acti", function (event) {
        var Id = $(this).data("id");
        var Nom = $(this).data("nom");
        var Accion = "";
        var Boton = "";
        var Tipo = "";

        if ($(this).is(":checked")) {
            var Acti = 1;
            Accion = "activar";
            Boton = "#468847";
            Tipo = "success";
        } else {
            var Acti = 0;
            Accion = "inactivar";
            Boton = "#f0ad4e";
            Tipo = "warning";
        }

        swal(
            {
                title: "¿Desea " + Accion + " el usuario " + Nom + "?",
                type: Tipo,
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: Boton,
                confirmButtonText: "¡si, " + Accion + "!",
                closeOnConfirm: false,
            },

            function () {
                $.ajax({
                    url: "accionesUsuarios.ajax.php",
                    type: "POST",
                    data: "accion=ACTIVAR&id_usua=" + Id + "&acti=" + Acti,
                    beforeSend: function () {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                    },
                    success: function (msj) {
                        if (msj == 1) {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se actualizo correctamente" }, function () {});
                            swal("¡" + Accion + "!", "El usuario " + Nom + " ha sido " + Accion + "!.", "success");
                        } else {
                            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                        }
                    },
                    error: function (msj) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                    },
                });
            }
        );
    });

    $(document).on("click", ".Cambo_Contra", function (event) {
        var Acti = 0;
        if ($(this).is(":checked")) {
            $("#contra").val("Demo1234");
        } else {
            $("#contra").val("");
        }
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
                    alert(data);
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

    $(document).on("click", ".llevar_funiconario", function (event) {
        event.preventDefault();
        $("#id_funcio").val($(this).data("id_funcio"));
        $("#cod_funcio").val($(this).data("num_documento"));
        $("#nom_funcio").val($(this).data("nombres"));
        $("#ape_funcio").val($(this).data("apellidos"));

        var Nombre = $(this).data("nombres").split(" ");
        var Apellidos = $(this).data("apellidos").split(" ");
        var Login = Nombre[0] + "." + Apellidos[0];
        $("#login").val(Login);
        $("#contra").val("Demo1234");
    });
});
