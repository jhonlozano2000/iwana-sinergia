$(document).ready(function () {
    $("#id_depen").focus();

    $("#BtnGuardar").click(function () {
        if ($("#id_depen").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia" }, function () {});
            $("#id_depen").focus();
        } else if ($("#procesos_id").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el proceso" }, function () {});
            $("#procesos_id").focus();
        } else if ($("#procedimiento_id").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el procedimeiento" }, function () {});
            $("#procedimiento_id").focus();
        } else if ($("#tipo_docu_id").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta tipo de documento" }, function () {});
            $("#tipo_docu_id").focus();
        } else if ($("#archivo").val() === "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el archivo a subir" }, function () {});
            $("#archivo").focus();
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
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información...", Imagen: "../../../public/assets/img/loading.gif" }, function () {});
                },
                success: function (msj) {
                    var elmentos = msj.split("###");

                    if ((elmentos[0] = 1)) {
                        //Establesco el id del archivo subido
                        $("#archivo_id").val(elmentos[1]);
                        //Cambio la accion del formulario para enviar el archivo al servidor FTP
                        $("#accion").val("CALIDAD_UPLOAD");

                        var formData = new FormData($("#FrmDatos")[0]);

                        $.ajax({
                            url: "../../varios/ftp.acciones.php",
                            type: "POST",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                $("#DivAlerta").load("../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                            },
                            success: function (msj) {
                                listarArchivos($("#procedimiento_id").val());

                                if (msj == 1) {
                                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                                    $("#archivo").val("");
                                }

                                $("#accion").val("INSERTAR");
                            },
                        });
                    }
                },
                error: function () {
                    $("#DivAlerta").load("../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución" }, function () {});
                },
            });
        }
    });

    function listarArchivos(procedimientoId) {
        //Listo los tipos de documentos
        var tiposDocumentos;

        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=LISTAR_ARCHIVOS&procedimiento_id=" + procedimientoId,
            success: function (response) {
                let arcivos = JSON.parse(response);

                for (let item of arcivos) {
                    let newRow = `<tr id="tr${item.archivo_id}">
                                    <td>${item.nom_archivo_original}</td>
                                    <td>
                                        <button type="button" class="download-btn btn btn-success btn-sm btn-circle" data-id="${item.archivo_id}" data-ruta_id="${item.id_ruta}" data-nom_archivo_original="${item.nom_archivo_original}" data-nom_archivo_unico="${item.nom_archivo_unico}"><i class="glyphicon glyphicon-cloud-download"></i></button>
                                        <button type="button" class="delete-btn btn btn-danger btn-sm btn-circle" data-id="${item.archivo_id}"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>`;

                    $(`#tablaArchivos${item.tipo_docu_id} tbody`).append(newRow);
                }
            },
        });
    }

    $(document).on("click", ".download-btn", function (e) {
        e.preventDefault();

        let id = $(this).data("id");
        let rutaId = $(this).data("ruta_id");
        let nomArchivoOriginal = $(this).data("nom_archivo_unico");
        let nomArchivoUnico = $(this).data("nom_archivo_unico");

        $.ajax({
            url: "../../varios/ftp.acciones.php",
            type: "POST",
            data: "accion=CALIDAD_DESCARGAR&archivo_id=" + id + "&id_ruta=" + rutaId + "&nomArchivoOrigina=" + nomArchivoOriginal + "&nomArchivoUnico=" + nomArchivoUnico,
            beforeSend: function () {
                $("#DivAlerta").load("../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
            },
            success: function (msj) {
                var elementos = msj.split("###");

                if ((elementos[0] = 1)) {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                    window.open("../../../archivos/temp/calidad/" + elementos[1], "_blank");
                }

                $("#accion").val("INSERTAR");
            },
        });
    });

    // Manejar clics en los botones de eliminación
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault();

        let id = $(this).data("id");
        console.log(id);
        $.ajax({
            url: "acciones.ajax.php",
            type: "POST",
            data: "accion=ELIMINAR&archivo_id=" + id,
            beforeSend: function () {
                $("#DivAlerta").load("../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
            },
            success: function (msj) {
                console.log(msj);
                if ((msj = 1)) {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se elimino correctamente" }, function () {});

                    var row = document.getElementById(`tr${id}`);
                    row.remove();
                }
            },
        });
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

    $("#id_depen").change(function () {
        $("#id_depen option:selected").each(function () {
            var idDepen = $(this).val();

            $.post("../../varios/combo_Procesos.php", { idDepen: idDepen }, function (data) {
                $("#procesos_id").html(data);
            });
        });
    });

    $("#procesos_id").change(function () {
        $("#procesos_id option:selected").each(function () {
            var idProceso = $(this).val();

            $.post("../../varios/combo_Procedimientos.php", { idProceso: idProceso }, function (data) {
                $("#procedimiento_id").html(data);
            });
        });
    });

    $("#procedimiento_id").change(function () {
        listarArchivos($(this).val());
    });
});
