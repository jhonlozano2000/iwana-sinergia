SELECT CONCAT(DATE_FORMAT(NOW(), '%Y%m%d'),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
FROM archivo_radica_recibidos
WHERE YEAR(fechor_radica) = YEAR(NOW())
/*
20200317-00687
*/
SELECT id_radica, fechor_radica 
FROM archivo_radica_recibidos
WHERE YEAR(fechor_radica) = YEAR(NOW())

SELECT id_radica, SUBSTR(id_radica, 10, LENGTH(id_radica)), CONVERT(SUBSTR(id_radica, 10, LENGTH(id_radica)), SIGNED)
FROM archivo_radica_recibidos
WHERE YEAR(fechor_radica) = YEAR(NOW())


SELECT id_radica, fechor_radica 
FROM archivo_radica_recibidos
WHERE id_radica = '20200317-00687'

SELECT a.id_radica, CONVERT(SUBSTR(a.id_radica, 10, LENGTH(a.id_radica)), SIGNED)+1 AS inicio, MIN(CONVERT(SUBSTR(b.id_radica, 10, LENGTH(b.id_radica)), SIGNED)) - 1 AS fin
FROM   archivo_radica_recibidos AS a, archivo_radica_recibidos AS b
WHERE  CONVERT(SUBSTR(a.id_radica, 10, LENGTH(a.id_radica)), SIGNED) < CONVERT(SUBSTR(b.id_radica, 10, LENGTH(b.id_radica)), SIGNED)
GROUP  BY CONVERT(SUBSTR(a.id_radica, 10, LENGTH(a.id_radica)), SIGNED) HAVING inicio < MIN(CONVERT(SUBSTR(b.id_radica, 10, LENGTH(b.id_radica)), SIGNED))
