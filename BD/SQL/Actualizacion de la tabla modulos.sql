UPDATE `segu_modu` SET `nom_modu` = 'Digitalizar TRD' WHERE `id_modu` = '50'; 
INSERT INTO `segu_modu` (`nom_modu`) VALUES ('Digitalizar TVD'); 
UPDATE `segu_modu` SET `menu` = 'Men_OfiArchi_Digitalizacion_TRD' WHERE `id_modu` = '47'; 
UPDATE `segu_modu` SET `menu` = 'Men_OfiArchi_Digitalizacion_TVD' WHERE `id_modu` = '54'; 
UPDATE `segu_modu` SET `modu_padre` = '14' WHERE `id_modu` = '54'; 
INSERT INTO `iwana_sinergia`.`segu_modu` (`modu_padre`, `nom_modu`, `menu`) VALUES ('25', 'Rutas para archivos de calidad', 'Men_Config_Calidad'); 