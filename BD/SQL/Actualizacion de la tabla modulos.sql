UPDATE `iwana_chaparral`.`segu_modu` SET `nom_modu` = 'Digitalizar TRD' WHERE `id_modu` = '50'; 
INSERT INTO `iwana_chaparral`.`segu_modu` (`nom_modu`) VALUES ('Digitalizar TVD'); 
UPDATE `iwana_chaparral`.`segu_modu` SET `menu` = 'Men_OfiArchi_Digitalizacion_TRD' WHERE `id_modu` = '47'; 
UPDATE `iwana_chaparral`.`segu_modu` SET `menu` = 'Men_OfiArchi_Digitalizacion_TVD' WHERE `id_modu` = '54'; 
UPDATE `iwana_chaparral`.`segu_modu` SET `modu_padre` = '14' WHERE `id_modu` = '54'; 