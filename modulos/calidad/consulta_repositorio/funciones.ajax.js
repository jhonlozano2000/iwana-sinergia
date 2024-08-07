$(document).ready(function () {
    $("#id_depen").focus();

    function listarArchivos(procedimientoId) {
        $.ajax({
            url: "../repositorio/acciones.ajax.php",
            type: "POST",
            data: "accion=LISTAR_ARCHIVOS&procedimiento_id=" + procedimientoId,
            success: function (response) {
                let data = JSON.parse(response);
                let tiposArchivos = data.tiposArchivos;
                let archivosProcesos = data.archivosProcesos;
                console.log(tiposArchivos);
                console.log(archivosProcesos);

                /* let tab = `<ul class="nav nav-tabs" id="tab-01">`;
                for (let item of tiposArchivos) {
                    tab += `<li class="">
                        <a href="#tab${item.tipo_docu_id}">${item.nom_tipo_documento}</a>
                    </li>`;
                }
                tab += `</ul>`;

                $("#divTab").html(tab); */

                /* let divTab = `<div class="tab-content">`;
                let i;
                for (let item of tiposArchivos) {
                    divTab += `<div class="tab-pane" id="tab${item.tipo_docu_id}">
                    <div class="row">
                    <div class="col-md-12">
                    <table id="tablaArchivos<?php echo $item['tipo_docu_id'] ?>">
                    <tbody>0000</tbody>
                    </table>
                    </div>
                    </div>
                    </div>`;
                }
                divTab += `</div>`;

                $("#divTab").html(divTab); */
                /* let datos = `<table id="tablaArchivos${item.tipo_docu_id}">`;
                datos += `<tbody>`;
                for (let item of arcivos) {
                    datos += `<tr id="tr${item.archivo_id}">
                                    <td>${item.nom_archivo_original}</td>
                                    <td>
                                        <button type="button" class="download-btn btn btn-success btn-sm btn-circle" data-id="${item.archivo_id}" data-ruta_id="${item.id_ruta}" data-nom_archivo_original="${item.nom_archivo_original}" data-nom_archivo_unico="${item.nom_archivo_unico}"><i class="glyphicon glyphicon-cloud-download"></i></button>
                                    </td>
                                </tr>`;

                    //$(`#tablaArchivos${item.tipo_docu_id} tbody`).append(newRow);
                }
                datos += `</tbody></table>`;
                $("#tblArchivos").html(divTab); */
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
