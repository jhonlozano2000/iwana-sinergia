$(document).ready(function () {
    //FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on("click", "#BtnMostarInfoRadicadoRecibido", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $("#DivRadicadoRecibido").html(IdRadicado);

        $.ajax({
            url: "../../varios/tab_radicado_recibido_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoInfo").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_recibido_clasificacion.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoClasificacion").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_recibido_documentos.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivMostarDocumentosRecibido").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });

        $.ajax({
            url: "../../varios/tab_radicado_recibido_otra_info.php",
            type: "POST",
            data: "id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#alerta").empty();
                $("#DivOtraInfoRadicadoRecibido").html(msj);
            },
            error: function (msj) {
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
            },
        });
    });

    $(document).on("click", "#BtnNotificarPorEmail", function (event) {
        var IdRadicado = $(this).data("id_radicado");

        $.ajax({
            url: "../../../varios/enviar_email.php",
            type: "POST",
            data: "accion=CORRESPONDENCIA_RECIVIDA&id_radica=" + IdRadicado,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                console.log(msj);
                if (msj == 1) {
                    $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 4, mensaje: "La notificación de envio correctamente." }, function () {});
                } else {
                    $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                }
            },
            error: function (msj) {
                $("#DivAlertas").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
            },
        });
    });

    //FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
    //EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
    $(document).on("click", ".idradicado", function (event) {
        $("#id_radicado").val($(this).data("id_radicado"));
    });

    $("#BtnReportCorrespondenRecibidaPorVencer").click(function () {
        var url = "../../../reportes/ventanilla/pendientes/por_vencer_recibidos_excel.php";
        window.open(url);
    });

    $("#BtnReportCorresRecibidaPorDigital").click(function () {
        var url = "../../../reportes/ventanilla/pendientes/por_digital_recibidos_excel.php";
        window.open(url);
    });

    $("#BtnCargarParaNotificarPorEmail").click(function () {
        $.ajax({
            url: "listar_notificaiones_email.php",
            type: "POST",
            data: "",
            beforeSend: function () {
                $("#DivAlertasNotificaPorEmail").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success: function (msj) {
                $("#DivAlertasNotificaPorEmail").empty();
                if (msj != 1) {
                    $("#DivListarRadicadosParNotificacionPorEmail").html(msj);
                    $("#DivAlertasNotificaPorEmail").empty();
                } else {
                    $("#DivAlertasNotificaPorEmail").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                }
            },
            error: function (msj) {
                $("#DivAlertasNotificaPorEmail").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
            },
        });
    });

    $("#BtnEnvioNotificarMasivaPorEmail").click(function () {
        var IdRadicados = new Array();

        $("input[name='ChkNotifica[]']:checked").each(function () {
            IdRadicados.push($(this).val());
        });

        $.ajax({
            url: "../../../varios/enviar_email.php",
            type: "POST",
            data: "accion=CORRESPONDENCIA_RECIVIDA_MASIBA&IdRadicadoMasivo=" + IdRadicados,
            beforeSend: function () {
                $("#DivAlertasNotificaPorEmail").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando notificaciones, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertasNotificaPorEmail").load("../../../../config/mensajes.php", { alerta: 4, mensaje: "La notificaciones de enviaron correctamente." }, function () {});
                } else {
                    $("#DivAlertasNotificaPorEmail").load("../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                }
            },
            error: function (msj) {
                $("#DivAlertasNotificaPorEmail").load("../../../../config/mensajes.php", { alerta: 3, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
            },
        });
    });
});
