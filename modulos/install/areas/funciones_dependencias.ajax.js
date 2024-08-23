$(document).ready(function () {
    $("#btnGuardarDependencia").click(function () {
        if ($("#cod_depen").val() == "") {
            $("#DivAlertaDependencias").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el código de la dependencia.</div>');
            $("#cod_depen").focus();
        } else if ($("#cod_corres").val() == "") {
            $("#DivAlertaDependencias").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el código de correspondencia.</div>');
            $("#cod_corres").focus();
        } else if ($("#nom_depen").val() == "") {
            $("#DivAlertaDependencias").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de la dependencia.</div>');
            $("#nom_depen").focus();
        } else {
            var dataForm = new FormData($("#FrmDatosDependencias")[0]);

            $.ajax({
                url: "../../areas/dependencias/acciones.ajax.php",
                type: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaDependencias").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                },
                success: function (msj) {
                    console.log(msj);
                    if (msj == 1) {
                        $("#DivAlertaDependencias").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
                        $("#cod_depen").focus();
                        $("#cod_depen").val("");
                        $("#cod_corres").val("");
                        $("#nom_depen").val("");
                        $("#observa").val("");
                    } else {
                        $("#DivAlertaDependencias").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlertaDependencias").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                },
            });
        }
    });
});
