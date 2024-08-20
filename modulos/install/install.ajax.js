$(document).ready(function () {
    $("#btnCreateDB").click(function (e) {
        e.preventDefault();

        var dataForm = new FormData($("#login-form")[0]);
        dataForm.append("accion", "create_db");

        $("#btnCreateDB").attr("disabled", "disabled");

        $.ajax({
            url: "install.ajax.php",
            type: "POST",
            data: dataForm,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Creando Bd y User de iwana, por favor espere. </div>');
            },
            success: function (msj) {
                if (msj == 1) {
                    $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> Bd y User de iwana creados correctamente.</div>');

                    setTimeout(function () {
                        window.location.href = "otras_configuraciones/index.php";
                    }, 2000);
                } else {
                    $("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + "</div>");
                }
            },
        });

        $("#btnCreateDB").removeAttr("disabled");
    });
});
