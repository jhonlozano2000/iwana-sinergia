$(document).ready(function () {
    $("#btnGuardarConfiguracion").click(function (e) {
        e.preventDefault();
        if ($("#nit").val() == "") {
            $("#DivAlerta").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el Nit.</div>');
            $("#nit").focus();
        } else if ($("#razo_soci").val() == "") {
            $("#DivAlerta").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta ela Razón Social.</div>');
            $("#razo_soci").focus();
        } else if ($("#id_depar").val() == 0) {
            $("#DivAlerta").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el departamento de recidencia del funcionario.</div>');
            $("#id_depar").focus();
        } else if ($("#id_muni").val() == 0) {
            $("#DivAlerta").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el municipio de recidencia del funcionario.</div>');
            $("#id_muni").focus();
        } else {
            var formData = new FormData($("#FrmDatos")[0]);

            $.ajax({
                url: "../../configuracion/otras/acciones.ajax.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
                    } else {
                        $("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + ".</div>");
                    }
                },
                error: function () {
                    $("#DivAlerta").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
                },
            });
        }
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
