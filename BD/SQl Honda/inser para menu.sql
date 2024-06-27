INSERT INTO `segu_modu` (`nom_modu`, `menu`, `acti`) VALUES ('Calidad', 'Men_Calidad', '1'); 
INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`, `menu`) VALUES ('53', 'Procesos', 'Men_Calidad_Procesos'); 
INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`) VALUES ('53', 'Procedimeintos'); 
UPDATE `segu_modu` SET `menu` = 'Men_Calidad_Procedimientos' WHERE `id_modu` = '55'; 
UPDATE `segu_modu` SET `acti` = '1' WHERE `id_modu` = '54'; 
UPDATE `segu_modu` SET `acti` = '1' WHERE `id_modu` = '55'; 
INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`, `menu`, `acti`) VALUES ('53', 'Tipo de documentos', 'Men_Calidad_Tipos_Documentos', '1'); 
INSERT INTO `segu_modu` (`modu_padre`, `nom_modu`, `menu`, `acti`) VALUES ('53', 'Repositorio', 'Men_Caldiad_Repositorio', '1'); 
