$(document).ready(function () {
    listarCargos();

    $("#BtnGuardarCargos").click(function () {
        if ($("#id_depen_cargos").val() == 0) {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta elegir la dependencia a la cual corresponde el cargo" }, function () {});
            $("#id_depen_cargos").focus();
        } else if ($("#nom_cargo").val() == "") {
            $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del cargo" }, function () {});
            $("#cod_oficina").focus();
        } else {
            var dataForm = new FormData($("#commentForm")[0]);
            dataForm.append("accion", "Insertar");

            $.ajax({
                url: "acciones_cargos.php",
                type: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información...", Imagen: "../../../public/assets/img/loading.gif" }, function () {});
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#nom_cargo").val("");
                        $("#nom_cargo").focus();
                        $("#observa_cargos").val("");
                        $("#acti").prop("checked", true);
                        listarCargos();
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
    $(document).on("click", "#BtnEliminarCargo", function (event) {
        var Id = $(this).data("id_cargo");
        var Nom = $(this).data("nom_cargo");

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
                    url: "../../areas/cargos/acciones.ajax.php",
                    type: "POST",
                    data: "accion=ELIMINAR&id_cargo=" + Id,
                    success: function (msj) {
                        if (msj == 1) {
                            $("#TrDatosCargos" + Id).remove();
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

    function listarCargos() {
        $.ajax({
            url: "listar_cargos.php",
            success: function (data) {
                $("#tblCargos").remove();
                $("#divCargos").append(data);
            },
        });
    }
});
