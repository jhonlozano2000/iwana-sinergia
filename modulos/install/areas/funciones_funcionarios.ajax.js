$(document).ready(function () {
    $("#cod_funcio").focus();

    $("#BtnGuardarFuncionario").click(function () {
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
        } else if ($("#id_depen_funcio").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la dependencia a la cual pertenece el funcionario.</div>');
            $("#id_depen_funcio").focus();
        } else if ($("#id_oficina_funcio").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir la oficina del funcionario.</div>');
            $("#id_oficina_funcio").focus();
        } else if ($("#id_cargo_funcio").val() == 0) {
            $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el cardo del funcionario.</div>');
            $("#id_cargo_funcio").focus();
        } else {
            var dataForm = new FormData($("#commentForm")[0]);
            dataForm.append("accion", "INSERTAR");

            $.ajax({
                url: "acciones_funcionarios.ajax.php",
                type: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
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

    $("#id_depen_funcio").change(function () {
        $("#id_depen_funcio option:selected").each(function () {
            var idDepen = $(this).val();
            $.post("../../varios/combo_oficinas.php", { idDepen: idDepen }, function (data) {
                console.log(data);
                $("#id_oficina_funcio").html(data);
            });

            $.post("../../varios/combo_cargos.php", { idDepen: idDepen }, function (data) {
                $("#id_cargo_funcio").html(data);
            });
        });
    });

    $("#id_depar").change(function () {
        $("#id_depar option:selected").each(function () {
            var idDepar = $(this).val();
            $.post("../../varios/combo_Municipios.php", { idDepar: idDepar }, function (data) {
                $("#id_muni").html(data);
            });
        });
    });
});
