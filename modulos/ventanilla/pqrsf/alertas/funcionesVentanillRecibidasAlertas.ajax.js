$(document).ready(function(){
	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
    $(document).on('click', '#BtnMostarInfoRadicadoRecibido', function(event){
        var IdRadicado = $(this).data('id_radicado');

        $('#DivRadicadoRecibido').html(IdRadicado)

        $.ajax({
            url: '../../varios/tab_radicado_recibido_info.php',
            type: 'POST',
            data: 'id_radica='+IdRadicado,
            beforeSend: function(){
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success:function(msj){
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoInfo").html(msj);
            },
            error:function(msj){
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
            }
        });

        $.ajax({
            url: '../../varios/tab_radicado_recibido_clasificacion.php',
            type: 'POST',
            data: 'id_radica='+IdRadicado,
            beforeSend: function(){
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success:function(msj){
                $("#alerta").empty();
                $("#DivMostarInfoRadicadoRecibidoClasificacion").html(msj);
            },
            error:function(msj){
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
            }
        });

        $.ajax({
            url: '../../varios/tab_radicado_recibido_documentos.php',
            type: 'POST',
            data: 'id_radica='+IdRadicado,
            beforeSend: function(){
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success:function(msj){
                $("#alerta").empty();
                $("#DivMostarDocumentosRecibido").html(msj);
            },
            error:function(msj){
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
            }
        });

        $.ajax({
            url: '../../varios/tab_radicado_recibido_otra_info.php',
            type: 'POST',
            data: 'id_radica='+IdRadicado,
            beforeSend: function(){
                $("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
            },
            success:function(msj){
                $("#alerta").empty();
                $("#DivOtraInfoRadicadoRecibido").html(msj);
            },
            error:function(msj){
                $("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
            }
        });
    });

    //FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
    //EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
    $(document).on('click', '.idradicado', function(event){
        $('#id_radicado').val($(this).data('id_radicado'));
    });
});