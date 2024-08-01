<?php
require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$OrigenCorrespon      = isset($_REQUEST['origen_correspon']) ? $_REQUEST['origen_correspon'] : null;
$FecDesde             = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta             = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;
$IdTercero            = isset($_REQUEST['id_tercero']) ? $_REQUEST['id_tercero'] : null;
$TipoTercer           = isset($_REQUEST['tipo_tercero']) ? $_REQUEST['tipo_tercero'] : null;
$IdFuncionario        = isset($_REQUEST['id_funcionario']) ? $_REQUEST['id_funcionario'] : null;
$IdDestina            = isset($_REQUEST['id_destinatario']) ? $_REQUEST['id_destinatario'] : null;
$IdDepen              = isset($_REQUEST['id_depen']) ? $_REQUEST['id_depen'] : null;
$IdSerie              = isset($_REQUEST['id_serie']) ? $_REQUEST['id_serie'] : null;
$IdSubSerie           = isset($_REQUEST['id_subserie']) ? $_REQUEST['id_subserie'] : null;
$IdTipoDoc            = isset($_REQUEST['id_tipodoc']) ? $_REQUEST['id_tipodoc'] : null;

$VerRadicado          = isset($_REQUEST['ChkRadicado']) ? true : null;
$VerTercero           = isset($_REQUEST['ChkTercero']) ? true : null;
$VerFuncionario       = isset($_REQUEST['ChkFuncionario']) ? true : null;
$VerFechaHoraRadica   = isset($_REQUEST['ChkFechaHoraRadica']) ? true : null;
$VerFechaDocumento    = isset($_REQUEST['ChkFechaDocumento']) ? true : null;
$VerFechaVencimiento  = isset($_REQUEST['ChkFechaVencimiento']) ? true : null;
$VerAsunto            = isset($_REQUEST['ChkAsunto']) ? true : null;
$VerDependencia       = isset($_REQUEST['ChkDependencia']) ? true : null;
$VerOficina           = isset($_REQUEST['ChkOficina']) ? true : null;
$VerSerie             = isset($_REQUEST['ChkSerie']) ? true : null;
$VerSubSerie          = isset($_REQUEST['ChkSubSerie']) ? true : null;
$VerTipoDocumento     = isset($_REQUEST['ChkTipoDocumento']) ? true : null;
$VerRadicadoRespuesta = isset($_REQUEST['ChkRadicadoRespuesta']) ? true : null;
$VerAsuntoRespuesta   = isset($_REQUEST['ChkAsuntoRespuesta']) ? true : null;
$VerFecHorRespuesta   = isset($_REQUEST['ChkFecHorRespuesta']) ? true : null;
$VerQuienRadico       = isset($_REQUEST['ChkQuienRadico']) ? true : null;
$VerRequiereDigital   = isset($_REQUEST['ChkRequiereDigital']) ? true : null;
$VerFormaRecepcion   = isset($_REQUEST['ChkFormaRecepcion']) ? true : null;

$Celda = "";
$Condicional = "";

if ($FecDesde != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`ra`.fechor_radica) >= '" . $FecDesde . "'";
    } else {
        $Condicional .= " AND DATE(`ra`.fechor_radica) >= '" . $FecDesde . "'";
    }
}

if ($FecHasta != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`ra`.fechor_radica) <= '" . $FecHasta . "'";
    } else {
        $Condicional .= " AND DATE(`ra`.fechor_radica) <= '" . $FecHasta . "'";
    }
}

/*
    if($_REQUEST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`ra`.asunto like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `ra`.asunto like '%".$_POST['asunto']."%'";
        }
    }
    */

if ($TipoTercer === 'NATURAL' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "RemiteContac.id_tercero = " . $IdTercero;
    } else {
        $Condicional .= " AND RemiteContac.id_tercero = " . $IdTercero;
    }
} elseif ($TipoTercer === 'JURIDICO' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "RemiteContac.id_empre = " . $IdTercero;
    } else {
        $Condicional .= " AND RemiteContac.id_empre = " . $IdTercero;
    }
}

if ($IdDestina != "") {
    if ($Condicional == "") {
        $Condicional .= "ResponFuncio.id_funcio = " . $IdDestina;
    } else {
        $Condicional .= " AND ResponFuncio.id_funcio = " . $IdDestina;
    }
}

if ($IdDepen != "0") {
    if ($Condicional == "") {
        $Condicional .= "depen.id_depen = " . $IdDepen;
    } else {
        $Condicional .= " AND depen.id_depen = " . $IdDepen;
    }
}

if ($IdDepen != "0" and $IdSerie != "0") {
    if ($Condicional == "") {
        $Condicional .= "serie.id_serie = " . $IdSerie;
    } else {
        $Condicional .= " AND serie.id_serie = " . $IdSerie;
    }
}

if ($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0") {
    if ($Condicional == "") {
        $Condicional .= "subserie.id_subserie = " . $IdSubSerie;
    } else {
        $Condicional .= " AND subserie.id_subserie = " . $IdSubSerie;
    }
}

if ($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0" and $IdTipoDoc != "0") {
    if ($Condicional == "") {
        $Condicional .= "tipodocu.id_tipodoc = " . $IdTipoDoc;
    } else {
        $Condicional .= " AND tipodocu.id_tipodoc = " . $IdTipoDoc;
    }
}

$Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`requie_respues`, `ra`.`asunto`, `ra`.`digital`,
                `forma_recibi`.`nom_formaenvi` AS `nom_forma_llega`, `funcio_respon`.`nom_funcio` AS `nom_funcio_respon`,
                `funcio_respon`.`ape_funcio` AS `ape_funcio_respon`, `depen_respon`.`nom_depen` AS `nom_depen_respon`,
                `ofi_respon`.`nom_oficina` AS `nom_oficina_respon`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`,
                `usua_regis`.`login`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                `ra`.`impri_rotu`, `serie`.`cod_serie`, `serie`.`nom_serie`, `sub_serie`.`cod_subserie`, `sub_serie`.`nom_subserie`,
                `tipo_doc`.`nom_tipodoc`, `ra`.`radica_respuesta`, `ra_envia`.`fechor_radica` AS `fechor_radica_respuesta`, `ra_envia`.`asunto` AS `asunto_respuesta`
            FROM `archivo_radica_recibidos` AS `ra`
                INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
                INNER JOIN `archivo_trd_subserie` AS `sub_serie` ON (`ra`.`id_subserie` = `sub_serie`.`id_subserie`)
                INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`ra`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`ra`.`id_remite` = `terce_contac`.`id_tercero`)
                INNER JOIN `segu_usua` AS `usua_regis` ON (`ra`.`id_usua_regis` = `usua_regis`.`id_usua`)
                INNER JOIN `archivo_trd_tipo_docu` AS `tipo_doc` ON (`ra`.`id_tipodoc` = `tipo_doc`.`id_tipodoc`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta_respon` ON (`ra_respon`.`id_funcio` = `funcio_deta_respon`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio_respon` ON (`funcio_deta_respon`.`id_funcio` = `funcio_respon`.`id_funcio`)
                INNER JOIN `areas_oficinas` AS `ofi_respon` ON (`funcio_deta_respon`.`id_oficina` = `ofi_respon`.`id_oficina`)
                INNER JOIN `areas_dependencias` AS `depen_respon` ON (`ofi_respon`.`id_depen` = `depen_respon`.`id_depen`)
                LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`usua_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                LEFT JOIN `archivo_radica_enviados` AS `ra_envia` ON (`ra_envia`.`id_radica` = `ra`.`radica_respuesta`)
            WHERE (ra_respon.respon = 1) AND  " . $Condicional . "
            ORDER BY `ra`.id_radica ASC";

$conexion = new conexion();
$Senten = $conexion->prepare($Sql);
$Senten->execute() or die(print_r($Senten->errorInfo() . " - " . $Sql, true));
$Result = $Senten->fetchAll();

echo json_encode($Result);
exit;
