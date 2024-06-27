INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`) VALUES ('25', 'Tipos de documentos'); 
UPDATE `segu_modu` SET `menu` = 'Men_Config_tipos_documentos' , `acti` = '1' WHERE `id_modu` = '53'

INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`, `menu`, `acti`) VALUES ('25', 'Tipos de respuestas', 'Men_Config_tipos_respuestas', '1'); 
INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`, `menu`, `acti`) VALUES ('25', 'Tipos de correspondencia', 'Men_Config_tipos_correspondencia', '1'); 

UPDATE `segu_modu` SET `menu` = 'Men_Config_tipos_respuestas' WHERE `id_modu` = '53'; 

DELETE FROM `segu_perfiles_deta` WHERE id_modu = 13
DELETE FROM `segu_modu` WHERE `id_modu` = '13'; 
