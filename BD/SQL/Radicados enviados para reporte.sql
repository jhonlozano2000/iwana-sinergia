SELECT
    `RaEnvia`.`id_radica`
    , `RaEnvia`.`fec_docu`
    , `RaEnvia`.`fechor_radica`
    , REPLACE(`RaEnvia`.`asunto`,'\n',' ') AS 'asunto'
    , `RaEnvia`.`digital`
    , `FormaEnvi`.`nom_formaenvi`
    , `Serie`.`nom_serie`
    , `SubSerie`.`nom_subserie`
    , `TipDoc`.`nom_tipodoc`
    , `re_recibido`.`id_radica` AS `radica_recibido`
    , `funcio_respon`.`nom_funcio` AS `nom_respon`
    , `funcio_respon`.`ape_funcio` AS `ape_respon`
    , `DestinaContac`.`num_docu`
    , `DestinaContac`.`nom_contac`
    , `DestinaContac`.`cargo`
    , `DestinaEmpre`.`razo_soci`
    , `FunRegis`.`nom_funcio`
    , `FunRegis`.`ape_funcio`
    , `config_tipos_respuestas`.`nom_respues`
FROM
    `archivo_radica_enviados` AS `RaEnvia`
    INNER JOIN `config_formaenvio` AS `FormaEnvi` 
        ON (`RaEnvia`.`id_formaenvio` = `FormaEnvi`.`id_formaenvio`)
    INNER JOIN `archivo_trd_series` AS `Serie` 
        ON (`Serie`.`id_serie` = `RaEnvia`.`id_serie`)
    INNER JOIN `archivo_trd_subserie` AS `SubSerie` 
        ON (`SubSerie`.`id_subserie` = `RaEnvia`.`id_subserie`)
    INNER JOIN `archivo_trd_tipo_docu` AS `TipDoc`
        ON (`RaEnvia`.`id_tipodoc` = `TipDoc`.`id_tipodoc`)
    INNER JOIN `gene_terceros_contac` AS `DestinaContac`
        ON (`RaEnvia`.`id_destina` = `DestinaContac`.`id_tercero`)
    INNER JOIN `segu_usua` AS `UsuaRegis`
        ON (`RaEnvia`.`id_usua_regis` = `UsuaRegis`.`id_usua`)
    LEFT JOIN `archivo_radica_recibidos` AS `re_recibido`
        ON (`RaEnvia`.`id_radica` = `re_recibido`.`radica_respuesta`)
    LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre`
        ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
    INNER JOIN `gene_funcionarios` AS `FunRegis`
        ON (`UsuaRegis`.`id_funcio` = `FunRegis`.`id_funcio`)
    INNER JOIN `archivo_radica_enviados_responsa` AS `RaRespon` 
        ON (`RaRespon`.`id_radica` = `RaEnvia`.`id_radica`)
    INNER JOIN `gene_funcionarios_deta` AS `funcio_respon_deta`
        ON (`RaRespon`.`id_funcio_deta` = `funcio_respon_deta`.`id_funcio_deta`)
    INNER JOIN `gene_funcionarios` AS `funcio_respon`
        ON (`funcio_respon_deta`.`id_funcio` = `funcio_respon`.`id_funcio`)
    INNER JOIN `config_tipos_respuestas` 
        ON (`RaEnvia`.`id_tipo_respue` = `config_tipos_respuestas`.`id_respue`)
WHERE (DATE(`RaEnvia`.`fechor_radica`) BETWEEN '2023-04-01' AND '2023-06-30'
    AND `RaRespon`.`respon` = 1)
ORDER BY `RaEnvia`.`id_radica` ASC;