$(document).ready(function () {
    $("#BtnEnviarParaTramite").click(function () {
        $("#accion").val("ENVIAR_PARA_TRAMITE");

        var QuienesFirman = new Array();
        var Responsables = new Array();
        var Proyectores = new Array();
        var HayQuienFirma = false;
        var HayResponsable = false;

        if ($('input[name="ChkFuncioQuienFirma"]').is(":checked")) {
            HayQuienFirma = true;
        } else {
            HayQuienFirma = false;
        }

        if ($('input[name="ChkFuncioRespon"]').is(":checked")) {
            HayResponsable = true;
        } else {
            HayResponsable = false;
        }

        $("input[name=ChkFuncioQuienFirma]").each(function (index) {
            QuienesFirman.push($(this).val());
        });

        $("input[name=ChkFuncioRespon]").each(function (index) {
            Responsables.push($(this).val());
        });

        $("input[name=ChkProyectores]").each(function (index) {
            Proyectores.push($(this).val());
        });

        if ($("#asunto").val() == "") {
            sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
            $("#asunto").focus();
        } else if (HayQuienFirma === false) {
            sweetAlert("Oops...", "Debe establecer quien o quienes firman la correspondencia!", "warning");
        } else if ($("#puede_firmar").val() == 0 && HayResponsable === false) {
            sweetAlert("Oops...", "Tu no estas autorizado para firmar documentos, por lo tanto debes elegir el o los responsables de la correspondencia.", "warning");
        } else if (HayResponsable === false) {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else if (Proyectores === "") {
            sweetAlert("Oops...", "Para enviar el documento para trámite, debe establecer al menos un proyector.", "warning");
        } else if ($("#id_destina").val() == "") {
            sweetAlert("Oops...", "Te hizo falta elegir el destinatario de la correspondencia.", "warning");
        } else if ($("#id_serie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir la serie.", "warning");
            $("#id_serie").focus();
        } else if ($("#id_subserie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir la subserie.", "warning");
            $("#id_subserie").focus();
        } else if ($("#id_tipodoc").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir el tipo documental.", "warning");
            $("#id_tipodoc").focus();
        } else {
            $("#multi option").each(function () {
                // Marcamos cada valor como seleccionado
                $("#multi option[value=" + this.value + "]").prop("selected", true);
            });

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data:
                    "accion=ENVIAR_PARA_TRAMITE&id_temp=" +
                    $("#id_temp").val() +
                    "&id_serie=" +
                    $("#id_serie").val() +
                    "&id_subserie=" +
                    $("#id_subserie").val() +
                    "&id_tipodoc=" +
                    $("#id_tipodoc").val() +
                    "&id_destina=" +
                    $("#id_destina").val() +
                    "&id_status=" +
                    $("#id_status").val() +
                    "&id_saludo=" +
                    $("#id_saludo").val() +
                    "&id_despedida=" +
                    $("#id_despedida").val() +
                    "&asunto=" +
                    $("#asunto").val() +
                    "&con_copia=" +
                    $("#con_copia").val() +
                    "&anexos=" +
                    $("#anexos").val() +
                    "&QuienesFirman=" +
                    QuienesFirman +
                    "&QuienFirmaPrincipal=" +
                    $("input:radio[name=ChkFuncioQuienFirma]:checked").val() +
                    "&Responsables=" +
                    Responsables +
                    "&Responsable=" +
                    $("input:radio[name=ChkFuncioRespon]:checked").val() +
                    "&RadicadoParaResponder=" +
                    $("#multi2").val() +
                    "&incluir_trd=" +
                    $("#incluir_trd").val() +
                    "&Proyectores=" +
                    Proyectores +
                    "&RadicadosRespuesta=" +
                    $("#multi2").val() +
                    "&de_donde_viene=" +
                    $("#de_donde_viene").val() +
                    "&id_radica_respues=" +
                    $("#id_radica_respues").val(),
                beforeSend: function () {
                    $("#DivAlertas").load("../../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                },
                success: function (msj) {
                    if (msj == 1) {
                        $("#DivAlertas").load("../../../../../config/mensajes.php", { alerta: 4, mensaje: "La plantilla se genero correctamente." }, function () {});

                        if ($("#de_donde_viene").val() == "CREAR_GRUPO_COLABORATIVO") {
                            setTimeout(function () {
                                window.location.href = "../grupos_colaborativos/index.php";
                            }, 100);
                        } else {
                            swal(
                                {
                                    title: "Perfecto!!!",
                                    text: "Tu plantilla se creo correctamente, para descargar debes dirigirte a Mis pendientes por tramitar.",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: false,
                                },
                                function () {
                                    setTimeout(function () {
                                        window.location.href = "../enviadas/index.php";
                                    }, 300);
                                }
                            );
                        }
                    } else {
                        $("#DivAlertas").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                },
            });
        }
    });

    $("#BtnDescargaPlantilla").click(function () {
        $("#accion").val("DESCARGAR_PLANTILLA");
        var QuienesFirman = new Array();
        var Responsables = new Array();
        var Proyectores = new Array();
        var HayQuienFirma = false;
        var HayResponsable = false;

        if ($('input[name="ChkFuncioQuienFirma"]').is(":checked")) {
            HayQuienFirma = true;
        } else {
            HayQuienFirma = false;
        }

        if ($('input[name="ChkFuncioRespon"]').is(":checked")) {
            HayResponsable = true;
        } else {
            HayResponsable = false;
        }

        $("input[name=ChkFuncioQuienFirma]").each(function (index) {
            QuienesFirman.push($(this).val());
        });

        $("input[name=ChkFuncioRespon]").each(function (index) {
            Responsables.push($(this).val());
        });

        $("input[name=ChkProyectores]").each(function (index) {
            Proyectores.push($(this).val());
        });

        if ($("#asunto").val() == "") {
            sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
            $("#asunto").focus();
        } else if (HayQuienFirma === false) {
            sweetAlert("Oops...", "Debe establecer quien o quienes firman la correspondencia!", "warning");
        } else if ($("#puede_firmar").val() == 0 && HayResponsable === false) {
            sweetAlert("Oops...", "Tu no estas autorizado para firmar documentos, por lo tanto debes elegir el o los responsables de la correspondencia.", "warning");
        } else if (HayResponsable === false) {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else if (Proyectores === "") {
            sweetAlert("Oops...", "Para enviar el documento para trámite, debe establecer al menos un proyector.", "warning");
        } else if ($("#id_destina").val() == "") {
            sweetAlert("Oops...", "Te hizo falta elegir el destinatario de la correspondencia.", "warning");
        } else if ($("#id_serie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir la serie.", "warning");
            $("#id_serie").focus();
        } else if ($("#id_subserie").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir la subserie.", "warning");
            $("#id_subserie").focus();
        } else if ($("#id_tipodoc").val() == 0) {
            sweetAlert("Oops...", "Te hizo falta elegir el tipo documental.", "warning");
            $("#id_tipodoc").focus();
        } else {
            $("#multi option").each(function () {
                // Marcamos cada valor como seleccionado
                $("#multi option[value=" + this.value + "]").prop("selected", true);
            });

            var formData = new FormData($("#FrmDatosPlantilla")[0]);

            $.ajax({
                url: "acciones.ajax.php",
                type: "POST",
                data:
                    "accion=DESCARGAR_PLANTILLA&id_temp=" +
                    $("#id_temp").val() +
                    "&id_serie=" +
                    $("#id_serie").val() +
                    "&id_subserie=" +
                    $("#id_subserie").val() +
                    "&id_tipodoc=" +
                    $("#id_tipodoc").val() +
                    "&id_destina=" +
                    $("#id_destina").val() +
                    "&id_status=" +
                    $("#id_status").val() +
                    "&id_saludo=" +
                    $("#id_saludo").val() +
                    "&id_despedida=" +
                    $("#id_despedida").val() +
                    "&asunto=" +
                    $("#asunto").val() +
                    "&con_copia=" +
                    $("#con_copia").val() +
                    "&anexos=" +
                    $("#anexos").val() +
                    "&QuienesFirman=" +
                    QuienesFirman +
                    "&QuienFirmaPrincipal=" +
                    $("input:radio[name=ChkFuncioQuienFirma]:checked").val() +
                    "&Responsables=" +
                    Responsables +
                    "&Responsable=" +
                    $("input:radio[name=ChkFuncioRespon]:checked").val() +
                    "&RadicadoParaResponder=" +
                    $("#multi2").val() +
                    "&incluir_trd=" +
                    $("#incluir_trd").val() +
                    "&Proyectores=" +
                    Proyectores +
                    "&RadicadosRespuesta=" +
                    $("#multi2").val(),
                beforeSend: function () {
                    $("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="20" height="20" />Enviando información...</div>');
                },
                success: function (msj) {
                    var Elementos = msj.split("#**#");

                    if (Elementos[0] == 1) {
                        $("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> La plantilla se descargo correctamente. </div>');
                        $("#id_temp").val(Elementos[1]);

                        window.open("../../../../varios/generar_plantilla.php?id_temp=" + Elementos[1] + "&Ciudad=" + Elementos[2] + "&Status=" + Elementos[3] + "&DestinaContacto=" + Elementos[4] + "&DestinaCargo=" + Elementos[5] + "&DestinaRazonSocial=" + Elementos[6] + "&DestinaDireccion=" + Elementos[7] + "&DestinaDomicilio=" + Elementos[8] + "&Asunto=" + Elementos[9] + "&Saludo=" + Elementos[10] + "&Despedida=" + Elementos[11] + "&QuienesFirman=" + Elementos[12] + "&Anexos=" + Elementos[13] + "&Con_Copia=" + Elementos[14] + "&Aprobado_Por=" + Elementos[15] + "&Proyector=" + Elementos[16] + "&Clasificacion_Documental=" + Elementos[17], "_blank");

                        /*
						setTimeout(function(){
							window.location.href = "../recibidas/index.php";
						}, 200);
						*/
                    } else {
                        $("#DivAlertas").html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> ' + msj + ".</div>");
                    }
                },
                error: function (msj) {
                    $("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, ' + msj + ".</div>");
                },
            });
        }
    });

    //FUNCION PARA BORRAR QUIEN FIRMA
    $(document).on("click", ".borrar_quien_firma", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkQuienFirma" + $(this).data("id")).attr("checked", false);
    });

    //FUNCION PARA LLEVAR QUIEN FIRMA
    $("#BtnLlevarQuienFirma").click(function (e) {
        $("input[name='ChkQuienFirma[]']:checked").each(function () {
            if (!$("#TblQuienFirma" + $(this).val()).length) {
                $("#TblQuienFirma tr:last").after('<tr id="TblQuienFirma' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_quien_firma" name="ChkFuncioQuienFirma" id="ChkFuncioQuienFirma' + $(this).val() + '" value="' + $(this).val() + '" data-id_quien_firma_dependencia="' + $(this).data("id_dependencia_quien_firma") + '" data-id_quien_firma_oficina="' + $(this).data("id_oficina_quien_firma") + '"><label for="ChkFuncioQuienFirma' + $(this).val() + '">' + $(this).data("nombre_quien_firma") + "</label></div></td><td>" + $(this).data("oficina_quien_firma") + '</td><td><button class="borrar_quien_firma btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA BORRAR UN RESPONSABLES
    $(document).on("click", ".borrar_responsables", function (event) {
        event.preventDefault();
        $(this).closest("tr").remove();
        $("#ChkResponsables" + $(this).data("id")).attr("checked", false);
    });

    //FUNCION PARA LLEVAR LOS RESPONSABLES
    $("#BtnLlevarResponsables").click(function (e) {
        $("input[name='ChkResponsables[]']:checked").each(function () {
            if (!$("#TblResponsales" + $(this).val()).length) {
                $("#TblResponsales tr:last").after('<tr id="TblResponsales' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon' + $(this).val() + '" value="' + $(this).val() + '" data-id_responsable_dependencia="' + $(this).data("id_responsable_dependencia") + '" data-id_responsable_oficina="' + $(this).data("id_responsable_oficina") + '"><label for="ChkFuncioRespon' + $(this).val() + '">' + $(this).data("nombre_responsables") + "</label></div></td><td>" + $(this).data("oficina_responsables") + '</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
            }
        });
    });

    //FUNCION PARA BORRAR UN PROYECTOR
    $(document).on("click", ".borrar_proyector", function (event) {
        event.preventDefault();

        $(this).closest("tr").remove();
        $("#ChkProyectores" + $(this).data("id")).attr("checked", false);

        var rowCount = $("#TblProyectores tr").length;

        if (rowCount === 1) {
            $("#BtnEnviarParaTramite").hide();
            $("#BtnGenerarPlanitlla").show();
        }
    });

    //FUNCION PARA LLEVAR LOS PROYECTORES
    $("#BtnLlevarProyector").click(function (e) {
        $("input[name='ChkProyectores[]']:checked").each(function () {
            if (!$("#TblProyectores" + $(this).val()).length) {
                $("#TblProyectores tr:last").after('<tr id="TblProyectores' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_proyector" name="ChkProyectores" id="ChkProyectores' + $(this).val() + '" value="' + $(this).val() + '" data-proyector_dependencia="' + $(this).data("dependencia_proyector") + '"><label for="ChkProyectores' + $(this).val() + '">' + $(this).data("nombre_proyector") + "</label></div></td><td>" + $(this).data("oficina_proyector") + '</td><td><button class="borrar_proyector btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
                $("#BtnEnviarParaTramite").show();
                $("#BtnGenerarPlanitlla").hide();
            }
        });
    });

    //FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO
    $("body").on("change", ".dependencia_del_responsable", function (event) {
        event.preventDefault();

        var IdDepen = $(this).data("id_responsable_dependencia");
        var IdOficina = $(this).data("id_responsable_oficina");
        var IncluirOficinaTRD = $("#incluir_oficina_trd").val();

        $("#id_depen").val(IdDepen);
        $("#id_oficina").val(IdOficina);

        $.post(
            "../../../../varios/combo_series.php",
            {
                id_depen: IdDepen,
                id_oficina: IdOficina,
                IncluirOficinaTRD: IncluirOficinaTRD,
            },
            function (data) {
                $("#id_serie").html(data);
            }
        );
    });

    $("#BtnBuscarDestinatarioNatural").click(function (e) {
        $("#TxtBusDestinaNaturales").focus();
    });

    //FUNCION PARA BUSCAR EL TERCERO NATURAL
    $("#TxtBusDestinaNaturales").keyup(function (e) {
        if (e.which == 13) {
            if ($("#TxtBusDestinaNaturales").val() === "") {
                $("#DivAlertasDestinaNaturales").load("../../../../config/funciones.php", { alerta: 3, mensaje: "Te hizo falta ingresar el criterio de busqueda" }, function () {});
                $("#TxtBusDestinaNaturales").focus();
            } else {
                $.ajax({
                    url: "../../../../varios/listar_tercero_correspondencia.php",
                    type: "POST",
                    data: "criterio=" + $("#TxtBusDestinaNaturales").val(),
                    beforeSend: function () {
                        $("#DivAlertasDestinaNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        if (msj != 1) {
                            $("#DivAlertasDestinaNaturales").empty();
                            $("#DivDestinatarioNaturales").html(msj);
                        } else {
                            $("#DivAlertasDestinaNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> NO se encontraron resultados.</div>');
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasDestinaNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        }
    });

    //FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
    $(document).on("click", "#BtnLlevarTercero", function (event) {
        var IdEmpre = $(this).data("id_empre");

        $("#id_destina").val($(this).data("id_tercero"));

        $("#cc_nit").val($(this).data("num_docu"));
        $("#remite_contacto").val($(this).data("nom_contac"));
        $("#remite_dir").val($(this).data("dir"));
        $("#remite_tel").val($(this).data("tel"));
        $("#remite_cel").val($(this).data("cel"));
        $("#remite_email").val($(this).data("email"));

        if (IdEmpre != "") {
            $("#remite_razo_soci").val($(this).data("razo_soci"));
            $("#DivOcultarTerceroRazoSoci").hide();
            $("#BtnCancelarTerceroNatural").click();
            $("#DivAlertasDestinaNaturales").empty();
        } else {
            $("#DivOcultarTerceroRazoSoci").show();
        }

        $("#BtnCancelarBusTercero").click();
    });

    $("#BtnNuevoTerceroJuridico").click(function (e) {
        $.post("../../../../varios/combo_Empresas.php", {}, function (data) {
            $("#id_empre_juridico").html(data);
        });
    });

    $("#id_serie").change(function () {
        var Responsables = new Array();
        var HayResponsable = false;

        $("input[name='ChkResponsables[]']:checked").each(function () {
            Responsables.push($(this).val());
        });

        if (!$('input[name="ChkFuncioRespon"]').is(":checked")) {
            HayResponsable = true;
        } else {
            HayResponsable = false;
        }

        if (Responsables === "") {
            sweetAlert("Oops...", "Te hizo falta el o los responsables de la correspondencia!", "warning");
            $("#BtnBuscarDestinatario").click();
        } else if (!$('input[name="ChkFuncioRespon"]').is(":checked")) {
            sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
        } else {
            $("#id_serie option:selected").each(function () {
                $.post(
                    "../../../../varios/combo_sub_series.php",
                    {
                        id_serie: $(this).val(),
                        id_depen: $("#id_depen").val(),
                        id_oficina: $("#id_oficina").val(),
                        IncluirOficinaTRD: $("#incluir_oficina_trd").val(),
                    },
                    function (data) {
                        $("#id_subserie").html(data);
                    }
                );
            });
        }
    });

    $("#id_subserie").change(function () {
        $("#id_subserie option:selected").each(function () {
            var id_serie = $("#id_serie").val();
            var id_sub_serie = $(this).val();

            $.post(
                "../../../../varios/combo_tipos_documentos.php",
                {
                    accion: $("#accion").val(),
                    id_depen: $("#id_depen").val(),
                    id_serie: id_serie,
                    id_sub_serie: id_sub_serie,
                },
                function (data) {
                    $("#id_tipodoc").html(data);
                }
            );
        });
    });

    $("#BtnGuardarTerceroNatural").click(function () {
        if ($("#nom_contac").val() == "") {
            $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del contacto." }, function () {});
            $("#nom_contac").focus();
        } else if ($("#id_depar_natural").val() == 0) {
            $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el departamento de recidencia del contacto." }, function () {});
            $("#id_depar_natural").focus();
        } else if ($("#id_muni_natural").val() == 0) {
            $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el municipio de recidencia del contacto." }, function () {});
            $("#id_muni_natural").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroNatural")[0]);

            $.ajax({
                url: "../../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 5, mensaje: "Enviando información, por favor espere..." }, function () {});
                },
                success: function (msj) {
                    var Elementos = msj.split("####");
                    if (Elementos[0] == 1) {
                        $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 4, mensaje: "El registro se almaceno correctamente" }, function () {});
                        $("#id_destina").val(msj.substring(8, msj.length));
                        $("#cc_nit").val($("#num_docu_contac").val());
                        $("#remite_contacto").val($("#nom_contac").val());
                        $("#DivReriteRazoSoci").hide();
                        $("#remite_dir").val($("#dir_contac").val());
                        $("#remite_tel").val($("#tel_contac").val());
                        $("#remite_cel").val($("#cel_contac").val());
                        $("#remite_email").val($("#email_contac").val());

                        $("#FrmDatosTerceroNatural")[0].reset();
                        $("#DivOcultarRemiteRazoSoci").hide();
                        $("#BtnCancelarTerceroNatural").click();
                        $("#DivAlertaTerceroNatural").empty();
                    } else {
                        $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroNatural").load("../../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    $("#BtnGuardarTerceroJutidico").click(function () {
        if ($("#nom_contac_juridico").val() == "") {
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta el nombre del contacto." }, function () {});
            $("#nom_contac_juridico").focus();
        } else if ($("#multi").val() == 0) {
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_empre_juridico").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroJuridico")[0]);

            $.ajax({
                url: "../../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroJutidico").load(
                        "../../../../../config/mensajes.php",
                        {
                            alerta: 5,
                            mensaje: "Enviando información, por favor espere...",
                        },
                        function () {}
                    );
                },
                success: function (msj) {
                    var Elementos = msj.split("####");
                    if (Elementos[0] == 1) {
                        $("#id_destina").val(Elementos[1]);
                        $("#cc_nit").val(Elementos[2]);
                        $("#remite_contacto").val($("#nom_contac_juridico").val());
                        $("#remite_razo_soci").val($('select[name="multi"] option:selected').text());
                        $("#remite_dir").val($("#dir_contac_juridico").val());
                        $("#remite_tel").val($("#tel_contac_juridico").val());
                        $("#remite_cel").val($("#cel_contac_juridico").val());
                        $("#remite_email").val($("#email_contac_juridico").val());

                        $("#FrmDatosTerceroJuridico")[0].reset();
                        $("#BtnCancelarTerceroJutidico").click();
                        $("#DivOcultarRemiteRazoSoci").show();
                        $("#DivAlertaTerceroJutidico").empty();
                    } else {
                        $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    $("#BtnGuardarTerceroJutidicoConEmpresa").click(function () {
        if ($("#nit").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Nit. de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#nit").focus();
        } else if ($("#razo_soci").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la Razon Social de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#razo_soci").focus();
        } else if ($("#id_depar_juridico_empresa").val() == 0) {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_depar_juridico_empresa").focus();
        } else if ($("#id_muni_juridico_empresa").val() == 0) {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de la empresa del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#id_muni_juridico_empresa").focus();
        } else if ($("#nom_contac_juridico_empresa").val() == "") {
            $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>');
            $("#DivAlertaTerceroJutidico").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: "Te hizo falta al empresa del contacto." }, function () {});
            $("#nom_contac_juridico_empresa").focus();
        } else {
            var formData = new FormData($("#FrmDatosTerceroJuridicoConEmpresa")[0]);

            $.ajax({
                url: "../../../../general/terceros/acciones_tercero.ajax.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#DivAlertaTerceroJutidico").load(
                        "../../../../../config/mensajes.php",
                        {
                            alerta: 5,
                            mensaje: "Enviando información, por favor espere...",
                        },
                        function () {}
                    );
                },
                success: function (msj) {
                    var Elementos = msj.split("####");
                    if (Elementos[0] == 1) {
                        $("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
                        $("#id_destina").val(Elementos[1]);
                        $("#cc_nit").val($("#nit").val());
                        $("#remite_contacto").val($("#nom_contac_juridico_empresa").val());
                        $("#DivReriteRazoSoci").show();
                        $("#remite_razo_soci").val($("#razo_soci").val());
                        $("#remite_dir").val($("#dir_juridico_empresa").val());
                        $("#remite_tel").val($("#tel_juridico_empresa").val());
                        $("#remite_cel").val($("#cel_juridico_empresa").val());

                        $("#FrmDatosTerceroJuridicoConEmpresa")[0].reset();
                        $("#BtnCancelarTerceroJutidicoConEmpresa").click();
                        $("#DivAlertaTerceroJutidicoConEmpresa").empty();
                    } else {
                        $("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () {});
                    }
                },
                error: function (msj) {
                    $("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../../config/mensajes.php", { alerta: 1, mensaje: "Ha ocurrido un error durante la ejecución, " + msj }, function () {});
                },
            });
        }
    });

    //LIMPIAR FORMULARIO DE TERCEROS NATURALES
    $("#BtnCancelarTerceroNatural").click(function () {
        $("#FrmDatosTerceroNatural")[0].reset();
    });

    $("#id_depar_contac").change(function () {
        $("#id_depar_contac option:selected").each(function () {
            var idDepar = $(this).val();
            $.post(
                "../../../../varios/combo_Municipios.php",
                {
                    idDepar: idDepar,
                },
                function (data) {
                    $("#id_muni_contac").html(data);
                }
            );
        });
    });

    $("#id_depar_juridico_empresa").change(function () {
        $("#id_depar_juridico_empresa option:selected").each(function () {
            var idDepar = $(this).val();
            $.post(
                "../../../../varios/combo_Municipios.php",
                {
                    idDepar: idDepar,
                },
                function (data) {
                    $("#id_muni_juridico_empresa").html(data);
                }
            );
        });
    });

    $("#BtnBuscarRadicadosRecibidos").click(function (e) {
        $("#TxtBusRadicadosRecibidosParaRespuesta").focus();
    });

    //FUNCION PARA BUSCAR LOS RADICADOS PARA RESPONDER
    $("#TxtBusRadicadosRecibidosParaRespuesta").keyup(function (e) {
        if (e.which == 13) {
            if ($("#TxtBusRadicadosRecibidosParaRespuesta").val() === "") {
                $("#DivAlertasRadicadosRecibidosParaRespuesta").load("../../../config/funciones.php", { alerta: 3, mensaje: "Te hizo falta ingresar el criterio de busqueda" }, function () {});
                $("#TxtBusRadicadosRecibidosParaRespuesta").focus();
            } else {
                $.ajax({
                    url: "../../../../ventanilla/varios/listar_radicados_recibidos_para_respuesta.php",
                    type: "POST",
                    data: "criterio=" + $("#TxtBusRadicadosRecibidosParaRespuesta").val(),
                    beforeSend: function () {
                        $("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                    },
                    success: function (msj) {
                        $("#DivAlertasRadicadosRecibidosParaRespuesta").empty();
                        if (msj != 1) {
                            $("#DivRadicadosRecibidosParaRespuesta").html(msj);
                        } else {
                            $("#DivRadicadosRecibidosParaRespuesta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + ".</div>");
                        }
                    },
                    error: function (msj) {
                        $("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + "</div>");
                    },
                });
            }
        }
    });

    //LIMPIAR FORMULARIO DE TERCEROS NATURALES
    $("#BtnCancelar").click(function () {
        window.location.href = "../pendientes_tramite/index.php";
    });
});
