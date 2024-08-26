$(document).ready(function () {
    listarOficinas();

    $("#BtnGuardarOficina").click(function () {
        if ($("#id_depen_oficina").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia a la cual corresponde la oficina" }, function () {});
            $("#id_depen_oficina").focus();
        } else if ($("#cod_oficina").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el código de la oficina" }, function () {});
            $("#cod_oficina").focus();
        } else if ($("#nom_oficina").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre de la oficina" }, function () {});
            $("#nom_oficina").focus();
        } else {
            var dataForm = new FormData($("#commentForm")[0]);
            dataForm.append("accion", "Insertar");

            $.ajax({
                url: "acciones_oficinas.ajax.php",
                type: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información...", Imagen: "../../../public/assets/img/loading.gif" }, function () {});
                },
                success: function (msj) {
                    console.log(msj);
                    if (msj == 1) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#cod_oficina").focus();
                        $("#cod_oficina").val("");
                        $("#cod_corres_oficina").val("");
                        $("#nom_oficina").val("");
                        $("#observa_oficina").val("");
                        listarOficinas();
                    } else {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function () {
                    $("#DivAlerta").load("../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución" }, function () {});
                },
            });
        }
    });

    /**=============================================================================
     *
     *	función para eliminar
     *
     *===========================================================================**/
    $(document).on("click", "#BtnEliminarOficina", function (event) {
        var Id = $(this).data("id_oficina");
        var Nom = $(this).data("nom_oficina");

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
                    url: "../../areas/oficinas/acciones.ajax.php",
                    type: "POST",
                    data: "accion=ELIMINAR&id_oficina=" + Id,
                    success: function (msj) {
                        if (msj == 1) {
                            $("#TrDatosOficina" + Id).remove();
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

    function listarOficinas() {
        $.ajax({
            url: "listar_oficinas.php",
            success: function (data) {
                $("#tblOficinas").remove();
                $("#divOficinas").append(data);
            },
        });
    }
});
