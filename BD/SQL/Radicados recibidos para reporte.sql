SELECT
    `RadicaEntra`.`id_radica`
    , `RadicaEntra`.`fec_docu`
    , `RadicaEntra`.`fechor_radica`
    , `RadicaEntra`.`fec_venci`
    , REPLACE(`RadicaEntra`.`asunto`,'\n',' ') AS 'asunto'
    , `RadicaEntra`.`digital`
    , `FormaLlega`.`nom_formaenvi`
    , `TRDSeri`.`nom_serie`
    , `TRDSubSe`.`nom_subserie`
    , `TRDTipDoc`.`nom_tipodoc`
    , `RadicaEntra`.`radica_respuesta`
    , `funcio_respon`.`nom_funcio`
    , `funcio_respon`.`ape_funcio`
    , `gene_terceros_contac`.`nom_contac`
    , `gene_terceros_contac`.`cargo`
    , `gene_terceros_empresas`.`razo_soci`
    , `FuncioRegis`.`nom_funcio`
    , `FuncioRegis`.`ape_funcio`
FROM
    `archivo_radica_recibidos` AS `RadicaEntra`
    LEFT JOIN `archivo_trd_series` AS `TRDSeri` 
        ON (`RadicaEntra`.`id_serie` = `TRDSeri`.`id_serie`)
    LEFT JOIN `archivo_trd_subserie` AS `TRDSubSe`
        ON (`RadicaEntra`.`id_subserie` = `TRDSubSe`.`id_subserie`)
    LEFT JOIN `archivo_trd_tipo_docu` AS `TRDTipDoc`
        ON (`RadicaEntra`.`id_tipodoc` = `TRDTipDoc`.`id_tipodoc`)
    INNER JOIN `config_formaenvio` AS `FormaLlega`
        ON (`RadicaEntra`.`id_forma_llegada` = `FormaLlega`.`id_formaenvio`)
    INNER JOIN `segu_usua` AS `UsuaRegis`
        ON (`RadicaEntra`.`id_usua_regis` = `UsuaRegis`.`id_usua`)
    INNER JOIN `gene_terceros_contac` 
        ON (`RadicaEntra`.`id_remite` = `gene_terceros_contac`.`id_tercero`)
    INNER JOIN `gene_funcionarios_deta` AS `FuncioRegisDeta`
        ON (`UsuaRegis`.`id_funcio` = `FuncioRegisDeta`.`id_funcio`)
    INNER JOIN `gene_funcionarios` AS `FuncioRegis`
        ON (`FuncioRegisDeta`.`id_funcio` = `FuncioRegis`.`id_funcio`)
    LEFT JOIN `gene_terceros_empresas` 
        ON (`gene_terceros_contac`.`id_empre` = `gene_terceros_empresas`.`id_empre`)
    INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` 
        ON (`ra_respon`.`id_radica` = `RadicaEntra`.`id_radica`)
    INNER JOIN `gene_funcionarios_deta` AS `funcio_respon_deta`
        ON (`ra_respon`.`id_funcio` = `funcio_respon_deta`.`id_funcio_deta`)
    INNER JOIN `gene_funcionarios` AS `funcio_respon`
        ON (`funcio_respon_deta`.`id_funcio` = `funcio_respon`.`id_funcio`)
WHERE DATE(`RadicaEntra`.`fechor_radica`) BETWEEN '2023-01-01' AND '2023-12-31' AND (`RadicaEntra`.`fechor_radica` AND `ra_respon`.`respon` = 1) 
    ORDER BY `RadicaEntra`.`id_radica` ASC;