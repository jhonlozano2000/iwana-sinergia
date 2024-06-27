/*TRANSFERIR COMUNICACIONES RECIBIDAS*/
UPDATE archivo_radica_recibidos_responsa SET id_funcio = 263 WHERE `id_funcio` IN(42, 165, 245, 249);
UPDATE archivo_radica_recibidos_pase SET id_funcio_deta_origen = 263 WHERE `id_funcio_deta_origen` IN(42, 165, 245, 249);
UPDATE archivo_radica_recibidos_grupos_colaborativo SET id_funcio_deta_asigno = 263 WHERE `id_funcio_deta_asigno` IN(42, 165, 245, 249);

/*TRANSFERIR COMUNICACIONES ENVIADAS*/
UPDATE archivo_radica_enviados_responsa SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_enviados_proyector SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_enviados_quienes_firman SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);

/*TRANSFERIR COMUNICACIONES INTERNAS*/
UPDATE archivo_radica_interna_responsa SET id_funcio = 263 WHERE `id_funcio` IN(42, 165, 245, 249);
UPDATE archivo_radica_interna_proyectores SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_interna_destinata SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_interna_destinata SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);

/*TRANSFERIR COMUNICACIONES TEMPORALES*/
UPDATE archivo_radica_enviados_temp_responsa SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_enviados_temp_quienes_firman SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_enviados_temp_proyector SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);
UPDATE archivo_radica_enviados_temp_nota SET id_funcio_deta = 263 WHERE `id_funcio_deta` IN(42, 165, 245, 249);


SELECT * FROM `gene_funcionarios_deta` WHERE `id_funcio_deta` IN(42, 165, 245, 249);